@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
    @php
        $tx = $booking->transaction;
        $txStatus = optional($tx)->status;
        $locked = $booking->status === 'cancelled' || $txStatus !== 'pending';
        $txLabel = match ($txStatus) {
            'lunas' => 'LUNAS',
            'dibatalkan' => 'DIBATALKAN',
            'pending' => 'PENDING',
            default => '-',
        };
    @endphp

    <div class="mb-4">
        <div class="text-uppercase small text-muted fw-semibold">Pembayaran</div>
        <h1 class="h4 fw-bold mb-1">Selesaikan pembayaran</h1>
        <div class="text-muted small">Booking: <span class="fw-semibold">{{ $booking->booking_code }}</span> • Kursi: <span class="fw-semibold">{{ $booking->seat->seat_number }}</span></div>
        <div class="stepper mt-3">
            <span class="step"><i class="bi bi-1-circle"></i> Cari</span>
            <span class="step"><i class="bi bi-2-circle"></i> Booking</span>
            <span class="step active"><i class="bi bi-3-circle"></i> Bayar</span>
            <span class="step"><i class="bi bi-4-circle"></i> E-ticket</span>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="surface p-4 p-lg-5 h-100">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                    <div>
                        <div class="text-uppercase small text-muted fw-semibold">Ringkasan</div>
                        <div class="fw-bold">{{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</div>
                        <div class="text-muted small">{{ $booking->schedule->departure_date->format('d M Y') }} • {{ $booking->schedule->departure_time }} • {{ $booking->schedule->bus->name }}</div>
                    </div>
                    <div class="text-lg-end">
                        <div class="text-muted small">Total</div>
                        <div class="h5 fw-bold mb-0">Rp {{ number_format($tx->amount ?? 0, 0, ',', '.') }}</div>
                        <span class="pill {{ $txStatus === 'lunas' ? 'pill-success' : ($txStatus === 'pending' ? 'pill-soft' : 'pill-muted') }} mt-2">{{ $txLabel }}</span>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="surface p-4 h-100">
                            <div class="text-uppercase small text-muted fw-semibold">Transfer Bank</div>
                            <div class="fw-bold mt-1">BCA 1234567890</div>
                            <div class="text-muted small">a.n. PO Haryanto</div>
                            <div class="text-muted small mt-3">Catatan: isi bukti/catatan transfer di form sebelah.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="surface p-4 h-100">
                            <div class="text-uppercase small text-muted fw-semibold">QRIS</div>
                            <div class="fw-bold mt-1">Scan QR</div>
                            <div class="text-muted small">(demo) QR bisa ditampilkan sesuai kebutuhan.</div>
                            <div class="text-muted small mt-3">Setelah bayar, kirim catatan bukti untuk verifikasi admin.</div>
                        </div>
                    </div>
                </div>

                @if ($tx && $tx->proof_path)
                    <div class="mt-4">
                        <div class="text-uppercase small text-muted fw-semibold">Bukti terakhir</div>
                        <div class="text-muted">{{ $tx->proof_path }}</div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-5">
            <div class="surface p-4 p-lg-5">
                <div class="text-uppercase small text-muted fw-semibold">Kirim bukti</div>
                <h2 class="h5 fw-bold mb-2">Catatan/bukti pembayaran</h2>
                <p class="text-muted small mb-4">Contoh: “Transfer BCA 18:21, nominal sesuai tagihan.”</p>

                @if ($locked)
                    <div class="alert alert-warning mb-4">Pembayaran tidak bisa diubah karena status transaksi sudah final.</div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('bookings.ticket', $booking) }}" class="btn btn-brand"><i class="bi bi-ticket-perforated me-1"></i> Buka e-ticket</a>
                        <a href="{{ route('bookings.show', $booking) }}" class="btn btn-ghost"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                    </div>
                @else
                    <form method="POST" action="{{ route('bookings.payment.confirm', $booking) }}" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Bukti</label>
                            <textarea name="proof_text" rows="4" class="form-control @error('proof_text') is-invalid @enderror" placeholder="Tulis bukti/catatan pembayaran">{{ old('proof_text') }}</textarea>
                            @error('proof_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 d-grid gap-2">
                            <button class="btn btn-accent"><i class="bi bi-send me-1"></i> Kirim Bukti</button>
                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-ghost"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection