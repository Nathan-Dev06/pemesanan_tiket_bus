@extends('layouts.app')

@section('title', 'Hasil Pencarian Tiket')

@section('content')
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
        <div>
            <div class="text-uppercase small text-muted fw-semibold">Pencarian</div>
            <h1 class="h4 fw-bold mb-1">Jadwal tersedia</h1>
            <div class="text-muted small">
                Filter:
                <span class="fw-semibold">{{ $filters['origin'] ?? 'semua asal' }}</span> →
                <span class="fw-semibold">{{ $filters['destination'] ?? 'semua tujuan' }}</span>
                • <span class="fw-semibold">{{ $filters['date'] ?? 'semua tanggal' }}</span>
            </div>
        </div>
        <a href="{{ route('home') }}" class="btn btn-ghost btn-sm"><i class="bi bi-house-door me-1"></i> Beranda</a>
    </div>

    <div class="surface p-4 p-lg-5 mb-4">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
            <div>
                <div class="text-uppercase small text-muted fw-semibold">Ubah filter</div>
                <div class="fw-bold">Cari jadwal lain</div>
            </div>
        </div>

        <form action="{{ route('search') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Kota asal</label>
                <input type="text" name="origin" class="form-control" placeholder="Surabaya" value="{{ old('origin', $filters['origin'] ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tujuan</label>
                <input type="text" name="destination" class="form-control" placeholder="Denpasar" value="{{ old('destination', $filters['destination'] ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $filters['date'] ?? '') }}">
            </div>
            <div class="col-12 d-grid d-md-flex gap-2">
                <button class="btn btn-brand"><i class="bi bi-search me-1"></i> Cari</button>
                <a href="{{ route('search') }}" class="btn btn-ghost"><i class="bi bi-x-circle me-1"></i> Reset</a>
            </div>
        </form>
    </div>

    <div class="row g-3">
        @forelse ($schedules as $schedule)
            @php
                $availableSeats = $schedule->seats->where('status', 'available')->count();
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="surface p-4 h-100 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="pill pill-soft"><i class="bi bi-calendar-event"></i> {{ $schedule->departure_date->format('d M Y') }}</span>
                        <span class="pill {{ $availableSeats > 0 ? 'pill-success' : 'pill-muted' }}"><i class="bi bi-grid-3x3-gap-fill"></i> {{ $availableSeats }} kursi</span>
                    </div>

                    <div class="h5 fw-bold mb-1">{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</div>
                    <div class="text-muted small mb-2">{{ $schedule->bus->name }} • {{ $schedule->departure_time }}{{ $schedule->arrival_time ? ' - '.$schedule->arrival_time : '' }}</div>
                    @if ($schedule->route->transit_points)
                        <div class="text-muted small mb-3">{{ $schedule->route->transit_points }}</div>
                    @endif

                    <div class="d-flex justify-content-between align-items-end mt-auto">
                        <div>
                            <div class="text-muted small">Harga</div>
                            <div class="fw-bold">Rp {{ number_format($schedule->price, 0, ',', '.') }}</div>
                        </div>
                        <a href="{{ route('bookings.create', $schedule) }}" class="btn btn-brand {{ $availableSeats > 0 ? '' : 'disabled' }}">Pilih kursi</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="surface p-5 text-center text-muted">Tidak ada jadwal yang cocok dengan pencarian Anda.</div>
            </div>
        @endforelse
    </div>
@endsection