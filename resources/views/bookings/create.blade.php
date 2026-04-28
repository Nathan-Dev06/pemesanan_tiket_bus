@extends('layouts.app')

@section('title', 'Booking Tiket')

@section('content')
    <div class="mb-4">
        <div class="text-uppercase small text-muted fw-semibold">Booking</div>
        <h1 class="h4 fw-bold mb-1">Pilih kursi & isi data penumpang</h1>
        <div class="text-muted small">{{ $schedule->route->origin }} → {{ $schedule->route->destination }} • {{ $schedule->departure_date->format('d M Y') }} • {{ $schedule->departure_time }} • {{ $schedule->bus->name }}</div>
        <div class="stepper mt-3">
            <span class="step"><i class="bi bi-1-circle"></i> Cari</span>
            <span class="step active"><i class="bi bi-2-circle"></i> Booking</span>
            <span class="step"><i class="bi bi-3-circle"></i> Bayar</span>
            <span class="step"><i class="bi bi-4-circle"></i> E-ticket</span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="surface p-4 p-lg-5">
                <div class="mb-3">
                    <div class="text-uppercase small text-muted fw-semibold">Pilih kursi</div>
                    <div class="fw-bold">Klik kursi yang masih tersedia</div>
                    <div class="text-muted small">Harga: <span class="fw-semibold">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span></div>
                </div>

                <div class="seat-grid mb-4">
                    @foreach ($schedule->seats as $seat)
                        @php $occupied = in_array($seat->status, ['reserved', 'booked']); @endphp
                        <div class="seat-item {{ $occupied ? 'disabled' : '' }}">
                            @if (! $occupied)
                                <input type="radio" form="booking-form" id="seat-{{ $seat->id }}" name="seat_id" value="{{ $seat->id }}" required>
                                <label for="seat-{{ $seat->id }}">{{ $seat->seat_number }}</label>
                            @else
                                <input type="radio" disabled>
                                <label class="unavailable {{ $seat->status }}">{{ $seat->seat_number }}</label>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="d-flex flex-wrap gap-2 small">
                    <span class="pill pill-success"><i class="bi bi-check-circle"></i> Tersedia</span>
                    <span class="pill pill-muted"><i class="bi bi-x-circle"></i> Tidak tersedia</span>
                    <span class="pill pill-soft"><i class="bi bi-info-circle"></i> Wajib pilih 1 kursi</span>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="surface p-4 p-lg-5">
                <form id="booking-form" method="POST" action="{{ route('bookings.store', $schedule) }}" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <div class="text-uppercase small text-muted fw-semibold">Data penumpang</div>
                        <h2 class="h5 fw-bold mb-0">Isi data dengan benar</h2>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Nama penumpang</label>
                        <input type="text" name="passenger_name" class="form-control @error('passenger_name') is-invalid @enderror" value="{{ old('passenger_name', auth()->user()->name ?? '') }}" required>
                        @error('passenger_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="passenger_phone" class="form-control @error('passenger_phone') is-invalid @enderror" value="{{ old('passenger_phone') }}" required>
                        @error('passenger_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="passenger_email" class="form-control @error('passenger_email') is-invalid @enderror" value="{{ old('passenger_email', auth()->user()->email ?? '') }}" required>
                        @error('passenger_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Metode pembayaran</label>
                        <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                            <option value="bank_transfer">Transfer Bank</option>
                            <option value="qris">QRIS</option>
                        </select>
                        @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 d-grid gap-2">
                        <button class="btn btn-brand btn-lg"><i class="bi bi-check2-circle me-1"></i> Buat Booking</button>
                        <a href="{{ route('search') }}" class="btn btn-ghost"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection