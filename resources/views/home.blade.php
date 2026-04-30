@extends('layouts.app')

@section('title', 'PO Haryanto Ticket - Beranda')

@section('content')
    <!-- Tambahan CSS Khusus untuk Halaman Ini -->
    <style>
        /* Desain Background Hero & Overlay Biru */
        .hero-bg {
            position: relative;
            /* Kamu bisa ganti URL ini dengan asset lokal misal: url('{{ asset("images/bus-haryanto.jpg") }}') */
            background-image: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 1rem;
            overflow: hidden;
            color: #ffffff; /* Memaksa teks di hero menjadi putih */
        }
        
        /* Overlay biru gelap agar teks putih tetap terbaca jelas */
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background: linear-gradient(135deg, rgba(10, 37, 88, 0.95) 0%, rgba(10, 37, 88, 0.7) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Desain Ulang Kartu Pencarian */
        .search-card {
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            color: #212529; /* Memastikan teks di dalam card berwarna gelap/hitam */
        }

        .search-card label {
            font-weight: 600;
            color: #343a40;
            font-size: 0.9rem;
        }

        .search-card .form-control {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .search-card .form-control:focus {
            background-color: #ffffff;
            border-color: #0a2558;
            box-shadow: 0 0 0 0.25rem rgba(10, 37, 88, 0.25);
        }

        .stat-box {
            background-color: #f8f9fa;
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
            border: 1px solid #e9ecef;
        }

        .stat-box .num {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0a2558;
        }

        .stat-box .label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }
    </style>

    <section class="hero hero-bg p-4 p-lg-5 mb-5 mt-3">
        <div class="row g-4 align-items-center hero-content">
            <div class="col-lg-6">
                <!-- Tambahan text-white agar teks kontras dengan overlay -->
                <div class="badge bg-light text-dark mb-3 px-3 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-lightning-charge-fill text-warning"></i> Booking cepat • Kursi realtime
                </div>
                <h1 class="display-5 fw-bold mb-3 text-white">Pesan tiket PO Haryanto tanpa ribet.</h1>
                <p class="lead text-light mb-4">Cari rute, pilih kursi, isi data penumpang, lalu bayar. Semua langkah rapi dalam satu alur.</p>
                
                <div class="d-flex flex-wrap gap-3 mb-5">
                    <a href="#cari" class="btn btn-warning btn-lg fw-bold px-4 rounded-pill shadow-sm">
                        <i class="bi bi-search me-1"></i> Cari Tiket
                    </a>
                    <a href="{{ route('search') }}" class="btn btn-outline-light btn-lg fw-bold px-4 rounded-pill">
                        <i class="bi bi-calendar2-week me-1"></i> Lihat Jadwal
                    </a>
                </div>

                <div class="d-flex gap-3 text-light fw-medium small overflow-auto pb-2">
                    <span class="d-flex align-items-center gap-1"><i class="bi bi-1-circle fs-5"></i> Cari</span>
                    <i class="bi bi-chevron-right text-white-50 mt-1"></i>
                    <span class="d-flex align-items-center gap-1"><i class="bi bi-2-circle fs-5"></i> Pilih kursi</span>
                    <i class="bi bi-chevron-right text-white-50 mt-1"></i>
                    <span class="d-flex align-items-center gap-1"><i class="bi bi-3-circle fs-5"></i> Bayar</span>
                    <i class="bi bi-chevron-right text-white-50 mt-1"></i>
                    <span class="d-flex align-items-center gap-1"><i class="bi bi-4-circle fs-5"></i> E-ticket</span>
                </div>
            </div>

            <!-- BAGIAN FORM PENCARIAN YANG DI-REDESIGN -->
            <div class="col-lg-6">
                <div id="cari" class="search-card p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
                        <div>
                            <div class="text-uppercase small text-muted fw-bold mb-1">Mulai dari sini</div>
                            <h2 class="h3 fw-bold text-dark mb-0">Cari Jadwal</h2>
                        </div>
                    </div>

                    <form action="{{ route('search') }}" method="GET" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kota Asal</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" name="origin" class="form-control border-start-0 ps-0" placeholder="Contoh: Surabaya" value="{{ request('origin') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kota Tujuan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-pin-map"></i></span>
                                <input type="text" name="destination" class="form-control border-start-0 ps-0" placeholder="Contoh: Denpasar" value="{{ request('destination') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tanggal Keberangkatan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-calendar-event"></i></span>
                                <input type="date" name="date" class="form-control border-start-0 ps-0" value="{{ request('date') }}">
                            </div>
                        </div>
                        <div class="col-12 d-grid mt-4">
                            <!-- Menggunakan style button khusus agar warna birunya sesuai -->
                            <button class="btn btn-lg fw-bold text-white shadow-sm" style="background-color: #0a2558;">
                                <i class="bi bi-search me-2"></i> Tampilkan Jadwal
                            </button>
                        </div>
                    </form>

                    <div class="row g-3 mt-4 pt-4 border-top">
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="num">{{ $routes->count() }}</div>
                                <div class="label">Rute Aktif</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="num">{{ $schedules->count() }}</div>
                                <div class="label">Jadwal Tersedia</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- AKHIR BAGIAN FORM PENCARIAN -->
        </div>
    </section>

    <!-- Bagian Rekomendasi Rute -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
            <div>
                <div class="text-uppercase small text-muted fw-semibold">Rekomendasi</div>
                <h2 class="h4 fw-bold mb-0">Rute Populer</h2>
            </div>
        </div>

        <div class="row g-3">
            @forelse ($routes as $route)
                <div class="col-md-6 col-lg-4">
                    <a class="surface p-4 d-block text-decoration-none shadow-sm rounded-4 h-100 transition-hover" href="{{ route('search', ['origin' => $route->origin, 'destination' => $route->destination]) }}">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <div class="fw-bold text-dark fs-5">{{ $route->origin }} <i class="bi bi-arrow-right mx-1 text-muted"></i> {{ $route->destination }}</div>
                                <div class="text-muted small mt-1"><i class="bi bi-signpost-split me-1"></i> {{ $route->transit_points ?: 'Tanpa transit utama' }}</div>
                            </div>
                            <div class="btn btn-light btn-sm rounded-circle"><i class="bi bi-arrow-up-right"></i></div>
                        </div>
                        @if ($route->description)
                            <hr class="text-muted opacity-25">
                            <div class="text-muted small">{{ $route->description }}</div>
                        @endif
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="surface p-4 text-muted text-center rounded-4 shadow-sm">Belum ada rute aktif.</div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Bagian Jadwal Terbaru -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
            <div>
                <div class="text-uppercase small text-muted fw-semibold">Jadwal terbaru</div>
                <h2 class="h4 fw-bold mb-0">Pilih Keberangkatan</h2>
            </div>
            <a href="{{ route('search') }}" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-grid me-1"></i> Semua jadwal</a>
        </div>

        <div class="row g-3">
            @forelse ($schedules as $schedule)
                @php
                    $availableSeats = $schedule->seats->where('status', 'available')->count();
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="surface p-4 h-100 rounded-4 shadow-sm border-0">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-light text-dark border"><i class="bi bi-calendar-event text-primary"></i> {{ $schedule->departure_date->format('d M Y') }}</span>
                            <span class="badge {{ $availableSeats > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} border {{ $availableSeats > 0 ? 'border-success-subtle' : 'border-danger-subtle' }}">
                                <i class="bi bi-grid-3x3-gap-fill"></i> {{ $availableSeats }} kursi
                            </span>
                        </div>

                        <div class="h5 fw-bold mb-1 text-dark">{{ $schedule->route->origin }} <i class="bi bi-arrow-right text-muted mx-1"></i> {{ $schedule->route->destination }}</div>
                        <div class="text-muted small mb-4">
                            <i class="bi bi-bus-front"></i> {{ $schedule->bus->name }} &bull; <i class="bi bi-clock"></i> {{ $schedule->departure_time }}
                        </div>

                        <div class="d-flex justify-content-between align-items-end mt-auto">
                            <div>
                                <div class="text-muted small">Harga Tiket</div>
                                <div class="fw-bold text-primary fs-5">Rp {{ number_format($schedule->price, 0, ',', '.') }}</div>
                            </div>
                            <a href="{{ route('bookings.create', $schedule) }}" class="btn {{ $availableSeats > 0 ? 'btn-primary' : 'btn-secondary disabled' }} rounded-pill px-4">
                                Pilih
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="surface p-5 text-center text-muted rounded-4 shadow-sm">
                        <i class="bi bi-calendar-x fs-1 d-block mb-2 text-black-50"></i>
                        Belum ada jadwal untuk saat ini.
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Bagian Fitur Keunggulan -->
    <section class="row g-4 mb-5">
        <div class="col-lg-4">
            <div class="surface p-4 h-100 rounded-4 shadow-sm text-center">
                <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-shield-check fs-3"></i>
                </div>
                <div class="fw-bold mb-2 text-dark fs-5">Kursi Terkunci</div>
                <div class="text-muted small">Mengurangi risiko double-booking saat sistem sedang ramai dipesan penumpang lain.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="surface p-4 h-100 rounded-4 shadow-sm text-center">
                <div class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-credit-card fs-3"></i>
                </div>
                <div class="fw-bold mb-2 text-dark fs-5">Pembayaran Fleksibel</div>
                <div class="text-muted small">Bisa melalui Transfer Bank atau QRIS. Cukup kirim bukti bayar dan admin akan verifikasi.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="surface p-4 h-100 rounded-4 shadow-sm text-center">
                <div class="bg-warning-subtle text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-ticket-perforated fs-3"></i>
                </div>
                <div class="fw-bold mb-2 text-dark fs-5">E-Ticket Praktis</div>
                <div class="text-muted small">Tiket langsung tersimpan di HP. Tunjukkan kode booking atau QR Code saat boarding ke bus.</div>
            </div>
        </div>
    </section>
@endsection