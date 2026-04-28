@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="admin-hero p-4 p-lg-5 mb-4 position-relative overflow-hidden">
        <div class="row align-items-center position-relative" style="z-index:1;">
            <div class="col-lg-8">
                <div class="badge text-bg-light text-dark mb-3">Dashboard operasional</div>
                <h1 class="display-6 fw-bold mb-2">Kelola bus, rute, jadwal, booking, dan transaksi dari satu tempat.</h1>
                <p class="text-white-50 mb-0">Data demo sudah disiapkan untuk presentasi tugas. Fokus alur: pencarian, booking kursi, pembayaran, dan verifikasi admin.</p>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0 text-lg-end">
                <a href="{{ route('admin.schedules.create') }}" class="btn btn-warning btn-lg">Tambah Jadwal</a>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-2"><div class="admin-card bg-white p-4"><div class="text-secondary small">Bus</div><div class="h2 fw-bold mb-0">{{ $busCount }}</div></div></div>
        <div class="col-md-6 col-xl-2"><div class="admin-card bg-white p-4"><div class="text-secondary small">Rute</div><div class="h2 fw-bold mb-0">{{ $routeCount }}</div></div></div>
        <div class="col-md-6 col-xl-2"><div class="admin-card bg-white p-4"><div class="text-secondary small">Jadwal</div><div class="h2 fw-bold mb-0">{{ $scheduleCount }}</div></div></div>
        <div class="col-md-6 col-xl-2"><div class="admin-card bg-white p-4"><div class="text-secondary small">Booking</div><div class="h2 fw-bold mb-0">{{ $bookingCount }}</div></div></div>
        <div class="col-md-6 col-xl-2"><div class="admin-card bg-white p-4"><div class="text-secondary small">Transaksi</div><div class="h2 fw-bold mb-0">{{ $transactionCount }}</div></div></div>
        <div class="col-md-6 col-xl-2"><div class="admin-card bg-white p-4"><div class="text-secondary small">Pending</div><div class="h2 fw-bold mb-0">{{ $pendingTransactions->count() }}</div></div></div>
    </div>

    <div class="admin-card bg-white p-4 p-lg-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">Transaksi pending</h2>
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-dark btn-sm">Kelola transaksi</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Booking</th>
                        <th>Rute</th>
                        <th>Metode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendingTransactions as $transaction)
                        <tr>
                            <td>{{ $transaction->booking->booking_code }}</td>
                            <td>{{ $transaction->booking->schedule->route->origin }} → {{ $transaction->booking->schedule->route->destination }}</td>
                            <td>{{ strtoupper(str_replace('_', ' ', $transaction->payment_method)) }}</td>
                            <td><span class="badge text-bg-warning">{{ strtoupper($transaction->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4 text-secondary">Tidak ada transaksi pending.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection