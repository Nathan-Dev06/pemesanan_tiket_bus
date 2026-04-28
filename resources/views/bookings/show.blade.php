@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
    @php
        $transaction = $booking->transaction;
        $txStatus = optional($transaction)->status;
        $canPay = $booking->status !== 'cancelled' && $txStatus === 'pending';
        $bookingStatusIcon = match ($booking->status) {
            'confirmed' => 'bi-check-circle',
            'cancelled' => 'bi-x-circle',
            default => 'bi-hourglass-split',
        };
        $txLabel = match ($txStatus) {
            'lunas' => 'LUNAS',
            'dibatalkan' => 'DIBATALKAN',
            'pending' => 'PENDING',
            default => '-',
        };
    @endphp

    <div class="surface p-4 p-lg-5 mb-4">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <div class="text-uppercase small text-muted fw-semibold">Booking</div>
                <h1 class="h4 fw-bold mb-1">{{ $booking->booking_code }}</h1>
                <div class="text-muted small">{{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</div>
            </div>

            <div class="text-lg-end">
                <div class="status-pill {{ $booking->status }}">
                    <i class="bi {{ $bookingStatusIcon }}"></i>
                    {{ strtoupper($booking->status) }}
                </div>
                <div class="d-flex flex-wrap gap-2 mt-2 justify-content-lg-end">
                    @if ($canPay)
                        <a href="{{ route('bookings.payment', $booking) }}" class="btn btn-ghost"><i class="bi bi-credit-card me-1"></i> Pembayaran</a>
                    @endif
                    <a href="{{ route('bookings.ticket', $booking) }}" class="btn btn-brand"><i class="bi bi-ticket-perforated me-1"></i> E-ticket</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="surface p-4 h-100">
                <div class="text-uppercase small text-muted fw-semibold">Perjalanan</div>
                <div class="fw-bold mb-3">{{ $booking->schedule->bus->name }}</div>

                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-muted small">Rute</div>
                        <div class="fw-semibold">{{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Kursi</div>
                        <div class="fw-semibold">{{ $booking->seat->seat_number }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Tanggal</div>
                        <div class="fw-semibold">{{ $booking->schedule->departure_date->format('d M Y') }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Waktu</div>
                        <div class="fw-semibold">{{ $booking->schedule->departure_time }} - {{ $booking->schedule->arrival_time }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="surface p-4 mb-3">
                <div class="text-uppercase small text-muted fw-semibold">Penumpang</div>
                <div class="fw-bold mb-3">{{ $booking->passenger_name }}</div>

                <div class="row g-2">
                    <div class="col-12">
                        <div class="text-muted small">Telepon</div>
                        <div class="fw-semibold">{{ $booking->passenger_phone }}</div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">Email</div>
                        <div class="fw-semibold">{{ $booking->passenger_email }}</div>
                    </div>
                </div>
            </div>

            <div class="surface p-4">
                <div class="text-uppercase small text-muted fw-semibold">Pembayaran</div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div class="text-muted small">Status</div>
                    <span class="pill {{ $txStatus === 'lunas' ? 'pill-success' : ($txStatus === 'pending' ? 'pill-soft' : 'pill-muted') }}">{{ $txLabel }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div class="text-muted small">Nominal</div>
                    <div class="fw-bold">Rp {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div class="text-muted small">Metode</div>
                    <div class="fw-semibold">{{ ($transaction->payment_method ?? '') === 'qris' ? 'QRIS' : 'Transfer Bank' }}</div>
                </div>

                <hr class="my-3">

                @if ($booking->status === 'cancelled')
                    <div class="text-muted small">Booking dibatalkan. Silakan cari jadwal lain.</div>
                    <div class="d-grid mt-3">
                        <a href="{{ route('search') }}" class="btn btn-ghost"><i class="bi bi-search me-1"></i> Cari jadwal</a>
                    </div>
                @elseif ($txStatus === 'lunas')
                    <div class="text-muted small">Pembayaran sudah diverifikasi. E-ticket siap digunakan.</div>
                    <div class="d-grid mt-3">
                        <a href="{{ route('bookings.ticket', $booking) }}" class="btn btn-brand"><i class="bi bi-ticket-perforated me-1"></i> Buka e-ticket</a>
                    </div>
                @elseif ($canPay)
                    <div class="text-muted small">Kirim bukti pembayaran agar admin bisa memverifikasi.</div>
                    <div class="d-grid mt-3">
                        <a href="{{ route('bookings.payment', $booking) }}" class="btn btn-accent"><i class="bi bi-credit-card me-1"></i> Lanjut pembayaran</a>
                    </div>
                @else
                    <div class="text-muted small">Tiket dapat dibuka kapan saja dari halaman e-ticket.</div>
                    <div class="d-grid mt-3">
                        <a href="{{ route('bookings.ticket', $booking) }}" class="btn btn-ghost"><i class="bi bi-ticket-perforated me-1"></i> Buka e-ticket</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection