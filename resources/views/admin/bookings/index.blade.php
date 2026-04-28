@extends('layouts.admin')

@section('title', 'Data Booking')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <h1 class="h4 fw-bold mb-3">Data booking</h1>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr><th>Kode</th><th>Penumpang</th><th>Rute</th><th>Kursi</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->booking_code }}</td>
                            <td>{{ $booking->passenger_name }}</td>
                            <td>{{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</td>
                            <td>{{ $booking->seat->seat_number }}</td>
                            <td>{{ strtoupper($booking->status) }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-outline-dark">Detail</a>
                                <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Batalkan booking ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-danger">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection