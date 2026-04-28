<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Schedule;
use App\Models\TravelRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function index(): View
    {
        return view('admin.schedules.index', [
            'schedules' => Schedule::with(['bus', 'route'])->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.schedules.create', [
            'buses' => Bus::all(),
            'routes' => TravelRoute::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Schedule::create($request->validate([
            'bus_id' => ['required', 'exists:buses,id'],
            'route_id' => ['required', 'exists:routes,id'],
            'departure_date' => ['required', 'date'],
            'departure_time' => ['required'],
            'arrival_time' => ['required'],
            'price' => ['required', 'integer', 'min:0'],
            'seat_count' => ['required', 'integer', 'min:1', 'max:60'],
            'status' => ['required', 'in:active,inactive'],
        ]));

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil ditambahkan dan kursi otomatis dibuat.');
    }

    public function edit(Schedule $schedule): View
    {
        return view('admin.schedules.edit', [
            'schedule' => $schedule,
            'buses' => Bus::all(),
            'routes' => TravelRoute::all(),
        ]);
    }

    public function update(Request $request, Schedule $schedule): RedirectResponse
    {
        $schedule->update($request->validate([
            'bus_id' => ['required', 'exists:buses,id'],
            'route_id' => ['required', 'exists:routes,id'],
            'departure_date' => ['required', 'date'],
            'departure_time' => ['required'],
            'arrival_time' => ['required'],
            'price' => ['required', 'integer', 'min:0'],
            'seat_count' => ['required', 'integer', 'min:1', 'max:60'],
            'status' => ['required', 'in:active,inactive'],
        ]));

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule): RedirectResponse
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}