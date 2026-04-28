<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        return view('admin.transactions.index', [
            'transactions' => Transaction::with(['booking.user', 'booking.schedule.route', 'booking.seat'])->latest()->get(),
        ]);
    }

    public function verify(Request $request, Transaction $transaction): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,lunas,dibatalkan'],
        ]);

        $transaction->update([
            'status' => $validated['status'],
            'paid_at' => $validated['status'] === 'lunas' ? now() : null,
        ]);

        if ($transaction->booking) {
            $transaction->booking->update([
                'status' => $validated['status'] === 'lunas' ? 'confirmed' : ($validated['status'] === 'dibatalkan' ? 'cancelled' : 'pending'),
            ]);

            if ($validated['status'] === 'lunas') {
                $transaction->booking->seat?->update(['status' => 'booked']);
            }

            if ($validated['status'] === 'dibatalkan') {
                $transaction->booking->seat?->update(['status' => 'available', 'booking_id' => null]);
            }
        }

        return redirect()->route('admin.transactions.index')->with('success', 'Status transaksi diperbarui.');
    }
}