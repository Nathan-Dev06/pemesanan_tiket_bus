@extends('layouts.app')

@section('title', 'E-Ticket')

@section('content')
    @php
        $tx = $booking->transaction;
        $txStatus = optional($tx)->status;
        $statusLabel = match ($txStatus) {
            'lunas' => 'LUNAS',
            'dibatalkan' => 'DIBATALKAN',
            'pending' => 'PENDING',
            default => strtoupper($booking->status),
        };
        $statusPill = $txStatus === 'lunas' ? 'pill-success' : ($txStatus === 'pending' ? 'pill-soft' : 'pill-muted');
    @endphp

    <div class="mb-4">
        <div class="text-uppercase small text-muted fw-semibold">E-ticket</div>
        <h1 class="h4 fw-bold mb-1">Tiket digital</h1>
        <div class="text-muted small">Simpan kode booking dan tunjukkan saat boarding.</div>
        <div class="stepper mt-3">
            <span class="step"><i class="bi bi-1-circle"></i> Cari</span>
            <span class="step"><i class="bi bi-2-circle"></i> Booking</span>
            <span class="step"><i class="bi bi-3-circle"></i> Bayar</span>
            <span class="step active"><i class="bi bi-4-circle"></i> E-ticket</span>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="surface p-4 p-lg-5">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <div class="text-uppercase small text-muted fw-semibold">Kode booking</div>
                        <div class="h4 fw-bold mb-1">{{ $booking->booking_code }}</div>
                        <div class="text-muted small">Kursi <span class="fw-semibold">{{ $booking->seat->seat_number }}</span> • {{ $booking->passenger_name }}</div>
                    </div>
                    <div class="text-lg-end">
                        <span class="pill {{ $statusPill }}"><i class="bi bi-shield-check"></i> {{ $statusLabel }}</span>
                        <div class="text-muted small mt-2">Ref: {{ $tx?->reference_number ?? '-' }}</div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="surface p-4 h-100">
                            <div class="text-uppercase small text-muted fw-semibold">Rute</div>
                            <div class="fw-bold mt-1">{{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</div>
                            @if ($booking->schedule->route->transit_points)
                                <div class="text-muted small mt-1">{{ $booking->schedule->route->transit_points }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="surface p-4 h-100">
                            <div class="text-uppercase small text-muted fw-semibold">Jadwal</div>
                            <div class="fw-bold mt-1">{{ $booking->schedule->departure_date->format('d M Y') }}</div>
                            <div class="text-muted small">{{ $booking->schedule->departure_time }} - {{ $booking->schedule->arrival_time }}</div>
                            <div class="text-muted small mt-1">{{ $booking->schedule->bus->name }}</div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="surface p-4 h-100">
                            <div class="text-uppercase small text-muted fw-semibold">Penumpang</div>
                            <div class="fw-bold mt-1">{{ $booking->passenger_name }}</div>
                            <div class="text-muted small">{{ $booking->passenger_phone }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="surface p-4 h-100">
                            <div class="text-uppercase small text-muted fw-semibold">Email</div>
                            <div class="fw-bold mt-1">{{ $booking->passenger_email }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="surface p-4 h-100">
                            <div class="text-uppercase small text-muted fw-semibold">Harga</div>
                            <div class="fw-bold mt-1">Rp {{ number_format($tx->amount ?? 0, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                @if ($booking->status === 'cancelled' || $txStatus === 'dibatalkan')
                    <div class="alert alert-danger mb-4">Booking/transaksi dibatalkan. Silakan cari jadwal lain.</div>
                @elseif ($txStatus === 'pending')
                    <div class="alert alert-warning mb-4">Status masih <strong>pending</strong>. Jika sudah bayar, kirim bukti agar admin bisa memverifikasi.</div>
                @endif

                <div class="d-grid d-md-flex gap-2">
                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-brand"><i class="bi bi-receipt me-1"></i> Detail booking</a>
                    @if ($txStatus === 'pending' && $booking->status !== 'cancelled')
                        <a href="{{ route('bookings.payment', $booking) }}" class="btn btn-accent"><i class="bi bi-credit-card me-1"></i> Pembayaran</a>
                    @endif
                    <a href="{{ route('home') }}" class="btn btn-ghost"><i class="bi bi-house-door me-1"></i> Beranda</a>
                </div>
            </div>
        </div>
    </div>
@endsection