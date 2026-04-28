<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusController extends Controller
{
    public function index(): View
    {
        return view('admin.buses.index', ['buses' => Bus::latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.buses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Bus::create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'plate_number' => ['required', 'string', 'max:30', 'unique:buses,plate_number'],
            'class_type' => ['required', 'string', 'max:100'],
            'seat_capacity' => ['required', 'integer', 'min:1', 'max:60'],
            'facilities' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
        ]));

        return redirect()->route('admin.buses.index')->with('success', 'Bus berhasil ditambahkan.');
    }

    public function edit(Bus $bus): View
    {
        return view('admin.buses.edit', compact('bus'));
    }

    public function update(Request $request, Bus $bus): RedirectResponse
    {
        $bus->update($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'plate_number' => ['required', 'string', 'max:30', 'unique:buses,plate_number,'.$bus->id],
            'class_type' => ['required', 'string', 'max:100'],
            'seat_capacity' => ['required', 'integer', 'min:1', 'max:60'],
            'facilities' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
        ]));

        return redirect()->route('admin.buses.index')->with('success', 'Bus berhasil diperbarui.');
    }

    public function destroy(Bus $bus): RedirectResponse
    {
        $bus->delete();

        return redirect()->route('admin.buses.index')->with('success', 'Bus berhasil dihapus.');
    }
}