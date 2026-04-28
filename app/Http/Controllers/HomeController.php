<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\TravelRoute;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'routes' => TravelRoute::where('active', true)->take(6)->get(),
            'schedules' => Schedule::with(['route', 'bus', 'seats'])
                ->whereDate('departure_date', '>=', now()->toDateString())
                ->orderBy('departure_date')
                ->take(6)
                ->get(),
            'featuredBookings' => Booking::with(['schedule.route', 'seat'])
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }
}