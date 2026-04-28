<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin PO Haryanto')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --ink: #1f2937;
            --muted: #6b7280;
            --light: #f3f4f6;
            --bg: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #ede9fe 50%, #f0f9ff 100%);
            color: var(--ink);
        }

        /* Admin Navbar */
        .admin-navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 30px rgba(99, 102, 241, 0.2);
            border-bottom: none;
        }

        .admin-navbar .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: white !important;
        }

        .admin-navbar .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .admin-navbar .nav-link:hover {
            color: white !important;
        }

        .admin-navbar .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background: white;
            border-radius: 2px;
        }

        .admin-navbar .btn {
            background: rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
            font-weight: 600;
        }

        .admin-navbar .btn:hover {
            background: rgba(255, 255, 255, 0.3) !important;
        }

        /* Admin Container */
        .admin-container {
            max-width: 100%;
            padding: 2rem;
        }

        /* Cards */
        .card {
            border: 1px solid rgba(99, 102, 241, 0.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-radius: 1.25rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.15);
            transform: translateY(-4px);
        }

        .card-header {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(236, 72, 153, 0.05));
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 1.25rem 1.25rem 0 0 !important;
            padding: 1.5rem;
            font-weight: 600;
            color: var(--ink);
        }

        /* Table Styling */
        .table {
            border-collapse: collapse;
        }

        .table thead th {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(236, 72, 153, 0.08));
            border-bottom: 2px solid rgba(99, 102, 241, 0.2);
            font-weight: 700;
            color: var(--primary);
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid rgba(99, 102, 241, 0.08);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: rgba(99, 102, 241, 0.03);
        }

        /* Buttons */
        .btn {
            font-weight: 600;
            border-radius: 0.8rem;
            padding: 0.65rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #d97706);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            color: white;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        /* Forms */
        .form-control, .form-select {
            border: 1.5px solid rgba(99, 102, 241, 0.15);
            border-radius: 0.8rem;
            padding: 0.75rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            color: var(--ink);
        }

        .form-label {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.5rem;
        }

        /* Badges */
        .badge {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.6rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-primary {
            background: rgba(99, 102, 241, 0.15);
            color: var(--primary);
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.15);
            color: var(--warning);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 1rem;
            padding: 1.25rem;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
            border-left: 4px solid var(--success);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #7f1d1d;
            border-left: 4px solid var(--danger);
        }

        /* Page Title */
        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--ink);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-container {
                padding: 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .table {
                font-size: 0.875rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg admin-navbar sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2" style="margin-right: 0.5rem;"></i>
            Admin Panel
        </a>
        <button class="navbar-toggler btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <i class="bi bi-list" style="color: white; font-size: 1.25rem;"></i>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav ms-auto gap-3 align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-house"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.buses.index') }}"><i class="bi bi-bus-front"></i> Bus</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.routes.index') }}"><i class="bi bi-map"></i> Rute</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.schedules.index') }}"><i class="bi bi-calendar-check"></i> Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.bookings.index') }}"><i class="bi bi-ticket"></i> Booking</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.transactions.index') }}"><i class="bi bi-credit-card"></i> Transaksi</a></li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-light"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="admin-container">
    @if (session('success'))
        <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger"><i class="bi bi-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>