@extends('layouts.admin')

@section('title', 'Detail Booking Admin')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <div class="d-flex justify-content-between flex-wrap gap-3 mb-4">
            <div>
                <div class="text-uppercase text-secondary small fw-semibold">Booking</div>
                <h1 class="h4 fw-bold mb-0">{{ $booking->booking_code }}</h1>
            </div>
            <span class="badge text-bg-warning">{{ strtoupper($booking->status) }}</span>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-6"><div class="p-4 rounded-4 bg-light"><div class="small text-secondary">Penumpang</div><div class="fw-bold">{{ $booking->passenger_name }}</div><div class="small text-secondary">{{ $booking->passenger_phone }}</div></div></div>
            <div class="col-md-6"><div class="p-4 rounded-4 bg-light"><div class="small text-secondary">Perjalanan</div><div class="fw-bold">{{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</div><div class="small text-secondary">{{ $booking->schedule->departure_date->format('d M Y') }}</div></div></div>
        </div>
        <div class="row g-3">
            <div class="col-md-6"><div class="p-4 rounded-4 bg-light"><div class="small text-secondary">Kursi</div><div class="fw-bold">{{ $booking->seat->seat_number }}</div></div></div>
            <div class="col-md-6"><div class="p-4 rounded-4 bg-light"><div class="small text-secondary">Transaksi</div><div class="fw-bold">{{ strtoupper(optional($booking->transaction)->status ?? '-') }}</div></div></div>
        </div>
    </div>
@endsection