@extends('layouts.app')

@section('title', 'PO Haryanto - Pesan Tiket Bus Online')

@section('content')
<!-- Hero Section -->
<div class="hero-panel mb-5">
    <div class="container position-relative">
        <div class="row align-items-center py-5">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title mb-3">
                    <strong>Pesan Tiket Bus</strong><br>dengan Mudah dan Cepat
                </h1>
                <p class="hero-subtitle mb-4">
                    PO Haryanto menawarkan kenyamanan perjalanan Anda dengan harga terbaik dan layanan prima. Pesan tiket sekarang dan nikmati perjalanan impian Anda!
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('search') }}" class="btn btn-light btn-lg fw-bold">
                        <i class="bi bi-search me-2"></i>Cari Tiket
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg fw-bold">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <div style="font-size: 150px;">
                    <i class="bi bi-bus-front-fill" style="color: rgba(255,255,255,0.3);"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-5 mb-5">
    <div class="container">
        <h2 class="section-title text-center mb-4">Mengapa Memilih PO Haryanto?</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center">
                    <div class="card-body py-4">
                        <div style="font-size: 48px; color: var(--primary); margin-bottom: 1rem;">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <h5 class="card-title fw-bold">Harga Terjangkau</h5>
                        <p class="card-text text-muted small">Dapatkan harga tiket terbaik dengan berbagai pilihan kelas bus yang sesuai budget Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center">
                    <div class="card-body py-4">
                        <div style="font-size: 48px; color: var(--success); margin-bottom: 1rem;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="card-title fw-bold">Aman & Terpercaya</h5>
                        <p class="card-text text-muted small">Sistem keamanan berlapis dan pembayaran terenkripsi menjamin transaksi Anda aman.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center">
                    <div class="card-body py-4">
                        <div style="font-size: 48px; color: var(--warning); margin-bottom: 1rem;">
                            <i class="bi bi-clock"></i>
                        </div>
                        <h5 class="card-title fw-bold">Cepat & Mudah</h5>
                        <p class="card-text text-muted small">Pesan tiket hanya dalam beberapa klik dan dapatkan e-ticket langsung di email Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center">
                    <div class="card-body py-4">
                        <div style="font-size: 48px; color: var(--secondary); margin-bottom: 1rem;">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5 class="card-title fw-bold">Layanan Pelanggan</h5>
                        <p class="card-text text-muted small">Tim customer service kami siap membantu Anda 24/7 melalui berbagai channel komunikasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="card bg-light border-0 mb-5">
    <div class="card-body py-5 text-center">
        <h2 class="mb-3">Siap untuk Memulai Perjalanan Anda?</h2>
        <p class="text-muted mb-4">Jelajahi rute-rute populer kami dan temukan penawaran terbaik</p>
        <a href="{{ route('search') }}" class="btn btn-primary btn-lg fw-bold">
            <i class="bi bi-arrow-right me-2"></i>Cari Tiket Sekarang
        </a>
    </div>
</div>

<!-- About Section -->
<div class="py-5 mb-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h2 class="section-title">Tentang PO Haryanto</h2>
                <p class="text-muted mb-3">
                    PO Haryanto telah melayani jutaan penumpang sejak tahun 2000 dengan komitmen memberikan layanan terbaik dan pengalaman perjalanan yang nyaman. Kami memiliki armada modern dan sopir profesional yang berpengalaman.
                </p>
                <p class="text-muted mb-3">
                    Dengan teknologi terkini dan sistem pemesanan online yang mudah, kami memastikan setiap perjalanan Anda lancar dan menyenangkan.
                </p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>Armada Modern</strong></li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>Sopir Profesional</strong></li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>Rute Terpanjang di Indonesia</strong></li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>Harga Kompetitif</strong></li>
                </ul>
            </div>
            <div class="col-lg-6 text-center">
                <div class="card bg-light border-0">
                    <div class="card-body py-5">
                        <div style="font-size: 100px; color: var(--primary);">
                            <i class="bi bi-bus-front"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
