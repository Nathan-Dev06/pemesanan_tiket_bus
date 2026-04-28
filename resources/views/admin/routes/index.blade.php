@extends('layouts.admin')

@section('title', 'Data Rute')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 fw-bold mb-0">Data rute</h1>
            <a href="{{ route('admin.routes.create') }}" class="btn btn-dark">Tambah Rute</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr><th>Asal</th><th>Tujuan</th><th>Transit</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($routes as $route)
                        <tr>
                            <td>{{ $route->origin }}</td>
                            <td>{{ $route->destination }}</td>
                            <td>{{ $route->transit_points }}</td>
                            <td>{{ $route->active ? 'ACTIVE' : 'INACTIVE' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.routes.edit', $route) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                                <form action="{{ route('admin.routes.destroy', $route) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus rute ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection