@extends('layouts.admin')

@section('title', 'Data Jadwal')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 fw-bold mb-0">Data jadwal</h1>
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-dark">Tambah Jadwal</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr><th>Rute</th><th>Bus</th><th>Tanggal</th><th>Jam</th><th>Harga</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</td>
                            <td>{{ $schedule->bus->name }}</td>
                            <td>{{ $schedule->departure_date->format('d M Y') }}</td>
                            <td>{{ $schedule->departure_time }} - {{ $schedule->arrival_time }}</td>
                            <td>Rp {{ number_format($schedule->price, 0, ',', '.') }}</td>
                            <td>{{ strtoupper($schedule->status) }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                                <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?')">
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