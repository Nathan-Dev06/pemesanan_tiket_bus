<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        return view('admin.bookings.index', [
            'bookings' => Booking::with(['user', 'schedule.route', 'seat', 'transaction'])->latest()->get(),
        ]);
    }

    public function show(Booking $booking): View
    {
        $booking->load(['user', 'schedule.route', 'schedule.bus', 'seat', 'transaction']);

        return view('admin.bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking): RedirectResponse
    {
        $booking->update(['status' => 'cancelled']);
        $booking->seat?->update(['status' => 'available', 'booking_id' => null]);
        $booking->transaction?->update(['status' => 'dibatalkan', 'paid_at' => null]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking dibatalkan.');
    }
}