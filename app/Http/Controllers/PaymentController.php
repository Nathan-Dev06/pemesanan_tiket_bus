<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function show(Booking $booking): View
    {
        $booking->load(['transaction', 'schedule.route', 'schedule.bus', 'seat']);

        abort_unless(auth()->check() && auth()->id() === $booking->user_id, 403);

        return view('bookings.payment', compact('booking'));
    }

    public function confirm(Request $request, Booking $booking): RedirectResponse
    {
        abort_unless(auth()->check() && auth()->id() === $booking->user_id, 403);

        $booking->load('transaction');

        if (! $booking->transaction) {
            abort(404);
        }

        if ($booking->status === 'cancelled') {
            return redirect()->route('bookings.show', $booking)->with('error', 'Booking sudah dibatalkan.');
        }

        if ($booking->transaction->status === 'lunas') {
            return redirect()->route('bookings.ticket', $booking)->with('success', 'Pembayaran sudah diverifikasi.');
        }

        if ($booking->transaction->status === 'dibatalkan') {
            return redirect()->route('bookings.show', $booking)->with('error', 'Transaksi sudah dibatalkan.');
        }

        $validated = $request->validate([
            'proof_text' => ['required', 'string', 'max:255'],
        ]);

        $booking->transaction->update(['proof_path' => $validated['proof_text']]);

        return redirect()->route('bookings.ticket', $booking)->with('success', 'Bukti pembayaran dicatat. Admin akan memverifikasi.');
    }
}