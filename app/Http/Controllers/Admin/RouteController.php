<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RouteController extends Controller
{
    public function index(): View
    {
        return view('admin.routes.index', ['routes' => TravelRoute::latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.routes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        TravelRoute::create($request->validate([
            'origin' => ['required', 'string', 'max:100'],
            'destination' => ['required', 'string', 'max:100'],
            'transit_points' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'active' => ['required', 'boolean'],
        ]));

        return redirect()->route('admin.routes.index')->with('success', 'Rute berhasil ditambahkan.');
    }

    public function edit(TravelRoute $route): View
    {
        return view('admin.routes.edit', ['routeData' => $route]);
    }

    public function update(Request $request, TravelRoute $route): RedirectResponse
    {
        $route->update($request->validate([
            'origin' => ['required', 'string', 'max:100'],
            'destination' => ['required', 'string', 'max:100'],
            'transit_points' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'active' => ['required', 'boolean'],
        ]));

        return redirect()->route('admin.routes.index')->with('success', 'Rute berhasil diperbarui.');
    }

    public function destroy(TravelRoute $route): RedirectResponse
    {
        $route->delete();

        return redirect()->route('admin.routes.index')->with('success', 'Rute berhasil dihapus.');
    }
}