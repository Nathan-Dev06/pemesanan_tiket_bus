<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Schedule;
use App\Models\Transaction;
use App\Models\TravelRoute;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'busCount' => Bus::count(),
            'routeCount' => TravelRoute::count(),
            'scheduleCount' => Schedule::count(),
            'bookingCount' => Booking::count(),
            'transactionCount' => Transaction::count(),
            'pendingTransactions' => Transaction::with('booking.schedule.route')
                ->where('status', 'pending')
                ->latest()
                ->take(6)
                ->get(),
        ]);
    }
}