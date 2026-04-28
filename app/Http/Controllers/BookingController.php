<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(Schedule $schedule): View
    {
        $schedule->load(['route', 'bus', 'seats.booking']);

        return view('bookings.create', compact('schedule'));
    }

    public function store(Request $request, Schedule $schedule): RedirectResponse
    {
        $validated = $request->validate([
            'seat_id' => ['required', 'exists:seats,id'],
            'passenger_name' => ['required', 'string', 'max:255'],
            'passenger_phone' => ['required', 'string', 'max:20'],
            'passenger_email' => ['required', 'email', 'max:255'],
            'notes' => ['nullable', 'string', 'max:500'],
            'payment_method' => ['required', 'in:bank_transfer,qris'],
        ]);

        $booking = DB::transaction(function () use ($schedule, $validated) {
            $seat = Seat::where('id', $validated['seat_id'])
                ->where('schedule_id', $schedule->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($seat->status !== 'available') {
                abort(422, 'Kursi sudah terisi. Silakan pilih kursi lain.');
            }

            $booking = Booking::create([
                'booking_code' => 'BK-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
                'user_id' => Auth::id(),
                'schedule_id' => $schedule->id,
                'seat_id' => $seat->id,
                'passenger_name' => $validated['passenger_name'],
                'passenger_phone' => $validated['passenger_phone'],
                'passenger_email' => $validated['passenger_email'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending',
            ]);

            $seat->update([
                'status' => 'reserved',
                'booking_id' => $booking->id,
            ]);

            Transaction::create([
                'booking_id' => $booking->id,
                'payment_method' => $validated['payment_method'],
                'amount' => $schedule->price,
                'status' => 'pending',
                'reference_number' => 'TX-'.Str::upper(Str::random(8)),
            ]);

            return $booking;
        });

        return redirect()->route('bookings.show', $booking)->with('success', 'Booking berhasil dibuat.');
    }

    public function show(Booking $booking): View
    {
        $booking->load(['schedule.route', 'schedule.bus', 'seat', 'transaction', 'user']);

        abort_unless(
            Auth::check() && Auth::id() === $booking->user_id || Auth::guard('admin')->check(),
            403
        );

        return view('bookings.show', compact('booking'));
    }

    public function ticket(Booking $booking): View
    {
        $booking->load(['schedule.route', 'schedule.bus', 'seat', 'transaction']);

        abort_unless(
            Auth::check() && Auth::id() === $booking->user_id || Auth::guard('admin')->check(),
            403
        );

        return view('bookings.ticket', compact('booking'));
    }
}