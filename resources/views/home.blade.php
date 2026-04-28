@extends('layouts.app')

@section('title', 'PO Haryanto Ticket - Beranda')

@section('content')
    <section class="hero p-4 p-lg-5 mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="pill mb-3"><i class="bi bi-lightning-charge-fill"></i> Booking cepat • Kursi realtime</div>
                <h1 class="hero-title">Pesan tiket PO Haryanto tanpa ribet.</h1>
                <p class="hero-sub">Cari rute, pilih kursi, isi data penumpang, lalu bayar. Semua langkah rapi dalam satu alur.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="#cari" class="btn btn-accent btn-lg"><i class="bi bi-search me-1"></i> Cari Tiket</a>
                    <a href="{{ route('search') }}" class="btn btn-ghost btn-lg"><i class="bi bi-calendar2-week me-1"></i> Lihat Jadwal</a>
                </div>

                <div class="stepper mt-4">
                    <span class="step active"><i class="bi bi-1-circle"></i> Cari</span>
                    <span class="step"><i class="bi bi-2-circle"></i> Pilih kursi</span>
                    <span class="step"><i class="bi bi-3-circle"></i> Bayar</span>
                    <span class="step"><i class="bi bi-4-circle"></i> E-ticket</span>
                </div>
            </div>

            <div class="col-lg-6">
                <div id="cari" class="surface p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                        <div>
                            <div class="text-uppercase small text-muted fw-semibold">Mulai dari sini</div>
                            <h2 class="h4 fw-bold mb-0">Cari Jadwal</h2>
                        </div>
                        <span class="pill pill-soft"><i class="bi bi-wifi"></i> Online</span>
                    </div>

                    <form action="{{ route('search') }}" method="GET" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kota asal</label>
                            <input type="text" name="origin" class="form-control" placeholder="Surabaya" value="{{ request('origin') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tujuan</label>
                            <input type="text" name="destination" class="form-control" placeholder="Denpasar" value="{{ request('destination') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tanggal berangkat</label>
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        <div class="col-12 d-grid">
                            <button class="btn btn-brand btn-lg"><i class="bi bi-arrow-right-circle me-1"></i> Lihat Jadwal</button>
                        </div>
                    </form>

                    <div class="row g-2 mt-3">
                        <div class="col-6">
                            <div class="mini-stat">
                                <div class="mini-stat__num">{{ $routes->count() }}</div>
                                <div class="mini-stat__label">Rute aktif</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mini-stat">
                                <div class="mini-stat__num">{{ $schedules->count() }}</div>
                                <div class="mini-stat__label">Jadwal dekat</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
            <div>
                <div class="text-uppercase small text-muted fw-semibold">Rekomendasi</div>
                <h2 class="h5 fw-bold mb-0">Rute populer</h2>
            </div>
        </div>

        <div class="row g-3">
            @forelse ($routes as $route)
                <div class="col-md-6 col-lg-4">
                    <a class="surface p-4 d-block text-decoration-none" href="{{ route('search', ['origin' => $route->origin, 'destination' => $route->destination]) }}">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <div class="fw-bold">{{ $route->origin }} → {{ $route->destination }}</div>
                                <div class="text-muted small">{{ $route->transit_points ?: 'Tanpa transit utama' }}</div>
                            </div>
                            <div class="pill pill-soft"><i class="bi bi-arrow-up-right"></i></div>
                        </div>
                        @if ($route->description)
                            <div class="text-muted small mt-2">{{ $route->description }}</div>
                        @endif
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="surface p-4 text-muted">Belum ada rute aktif.</div>
                </div>
            @endforelse
        </div>
    </section>

    <section class="mb-4">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
            <div>
                <div class="text-uppercase small text-muted fw-semibold">Jadwal terbaru</div>
                <h2 class="h5 fw-bold mb-0">Pilih jadwal keberangkatan</h2>
            </div>
            <a href="{{ route('search') }}" class="btn btn-ghost btn-sm"><i class="bi bi-grid me-1"></i> Semua jadwal</a>
        </div>

        <div class="row g-3">
            @forelse ($schedules as $schedule)
                @php
                    $availableSeats = $schedule->seats->where('status', 'available')->count();
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="surface p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="pill pill-soft"><i class="bi bi-calendar-event"></i> {{ $schedule->departure_date->format('d M Y') }}</span>
                            <span class="pill {{ $availableSeats > 0 ? 'pill-success' : 'pill-muted' }}"><i class="bi bi-grid-3x3-gap-fill"></i> {{ $availableSeats }} kursi</span>
                        </div>

                        <div class="h5 fw-bold mb-1">{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</div>
                        <div class="text-muted small mb-3">{{ $schedule->bus->name }} • {{ $schedule->departure_time }}</div>

                        <div class="d-flex justify-content-between align-items-end">
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
                    <div class="surface p-5 text-center text-muted">Belum ada jadwal untuk saat ini.</div>
                </div>
            @endforelse
        </div>
    </section>

    <section class="row g-3">
        <div class="col-lg-4">
            <div class="surface p-4 h-100">
                <div class="pill pill-soft mb-3"><i class="bi bi-shield-check"></i> Aman</div>
                <div class="fw-bold mb-1">Kursi terkunci saat booking</div>
                <div class="text-muted small mb-0">Mengurangi risiko double-booking, khususnya saat ramai.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="surface p-4 h-100">
                <div class="pill pill-soft mb-3"><i class="bi bi-credit-card"></i> Fleksibel</div>
                <div class="fw-bold mb-1">Pembayaran transfer / QRIS</div>
                <div class="text-muted small mb-0">Cukup kirim catatan bukti bayar, admin verifikasi.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="surface p-4 h-100">
                <div class="pill pill-soft mb-3"><i class="bi bi-ticket-perforated"></i> Praktis</div>
                <div class="fw-bold mb-1">E-ticket langsung tersimpan</div>
                <div class="text-muted small mb-0">Tunjukkan kode booking saat boarding.</div>
            </div>
        </div>
    </section>
@endsection