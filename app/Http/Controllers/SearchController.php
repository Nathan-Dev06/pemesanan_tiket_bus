<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'origin' => ['nullable', 'string', 'max:100'],
            'destination' => ['nullable', 'string', 'max:100'],
            'date' => ['nullable', 'date'],
        ]);

        $schedules = Schedule::with(['route', 'bus', 'seats.booking'])
            ->when($request->filled('origin'), function ($query) use ($request) {
                $query->whereHas('route', function ($routeQuery) use ($request) {
                    $routeQuery->where('origin', 'like', '%'.$request->string('origin').'%');
                });
            })
            ->when($request->filled('destination'), function ($query) use ($request) {
                $query->whereHas('route', function ($routeQuery) use ($request) {
                    $routeQuery->where('destination', 'like', '%'.$request->string('destination').'%');
                });
            })
            ->when($request->filled('date'), function ($query) use ($request) {
                $query->whereDate('departure_date', $request->date('date'));
            })
            ->orderBy('departure_date')
            ->orderBy('departure_time')
            ->get();

        return view('search.results', [
            'filters' => $validated,
            'schedules' => $schedules,
        ]);
    }
}