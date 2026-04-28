@extends('layouts.admin')

@section('title', 'Data Bus')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 fw-bold mb-0">Data bus</h1>
            <a href="{{ route('admin.buses.create') }}" class="btn btn-dark">Tambah Bus</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr><th>Nama</th><th>Plat</th><th>Kelas</th><th>Kursi</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($buses as $bus)
                        <tr>
                            <td>{{ $bus->name }}</td>
                            <td>{{ $bus->plate_number }}</td>
                            <td>{{ $bus->class_type }}</td>
                            <td>{{ $bus->seat_capacity }}</td>
                            <td>{{ strtoupper($bus->status) }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.buses.edit', $bus) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                                <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus bus ini?')">
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