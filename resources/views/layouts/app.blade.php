<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PO Haryanto - Pemesanan Tiket Bus')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --brand: #0ea5e9;
            --brand-2: #14b8a6;
            --accent: #f97316;
            --accent-2: #fb7185;
            --ink: #0f172a;
            --muted: #64748b;
            --bg: #f8fafc;
            --card: rgba(255, 255, 255, 0.92);
            --border: rgba(2, 6, 23, 0.08);
            --shadow: 0 22px 70px rgba(2, 6, 23, 0.10);
            --radius: 1.25rem;

            --success-ink: #0f766e;
            --danger-ink: #9f1239;
            --warning-ink: #9a3412;
        }

        * { box-sizing: border-box; }

        html, body { height: 100%; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ink);
            background:
                radial-gradient(900px 520px at 12% -10%, rgba(14, 165, 233, 0.35), transparent 60%),
                radial-gradient(820px 520px at 92% 0%, rgba(251, 113, 133, 0.22), transparent 55%),
                radial-gradient(820px 520px at 45% 110%, rgba(20, 184, 166, 0.24), transparent 55%),
                var(--bg);
            line-height: 1.55;
        }

        /* Navbar */
        .app-navbar {
            background: rgba(248, 250, 252, 0.72);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            color: var(--ink);
        }

        .navbar-brand:hover { color: var(--ink); }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--brand), var(--brand-2));
            box-shadow: 0 14px 34px rgba(14, 165, 233, 0.25);
        }

        .brand-mark i { color: #fff; font-size: 1.15rem; }

        .nav-link {
            font-weight: 700;
            color: var(--ink) !important;
            opacity: 0.9;
        }

        .nav-link:hover { opacity: 1; }
        .nav-link.active { opacity: 1; }

        .dropdown-menu {
            border-radius: 1rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        /* Surfaces */
        .surface {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
        }

        .surface .surface {
            box-shadow: none;
            background: rgba(255, 255, 255, 0.70);
        }

        /* Hero */
        .hero {
            position: relative;
            overflow: hidden;
            border-radius: calc(var(--radius) + 0.25rem);
            background: linear-gradient(135deg, var(--brand), var(--brand-2) 55%, var(--accent));
            color: #fff;
            box-shadow: 0 26px 70px rgba(2, 6, 23, 0.18);
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: -120px -160px auto auto;
            width: 420px;
            height: 420px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            filter: blur(22px);
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: auto auto -180px -120px;
            width: 520px;
            height: 520px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            filter: blur(26px);
        }

        .hero > * { position: relative; z-index: 1; }

        .hero-title {
            font-size: clamp(2rem, 3.2vw, 3.25rem);
            font-weight: 900;
            letter-spacing: -0.03em;
            line-height: 1.06;
            margin-bottom: 0.75rem;
        }

        .hero-sub {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.05rem;
            margin-bottom: 1.25rem;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            font-weight: 800;
            font-size: 0.8rem;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.24);
        }

        .pill-soft {
            background: rgba(2, 6, 23, 0.04);
            border: 1px solid var(--border);
            color: var(--ink);
        }

        .pill-success {
            background: rgba(20, 184, 166, 0.12);
            border: 1px solid rgba(20, 184, 166, 0.22);
            color: var(--success-ink);
        }

        .pill-muted {
            background: rgba(100, 116, 139, 0.12);
            border: 1px solid rgba(100, 116, 139, 0.18);
            color: var(--muted);
        }

        /* Buttons */
        .btn {
            border-radius: 1rem;
            font-weight: 800;
            padding: 0.7rem 1rem;
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--brand), var(--brand-2));
            border: none;
            color: #fff;
            box-shadow: 0 14px 34px rgba(14, 165, 233, 0.25);
        }

        .btn-brand:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 18px 44px rgba(14, 165, 233, 0.30);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border: none;
            color: #fff;
            box-shadow: 0 14px 34px rgba(249, 115, 22, 0.22);
        }

        .btn-accent:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 18px 44px rgba(249, 115, 22, 0.28);
        }

        .btn-ghost {
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid var(--border);
            color: var(--ink);
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.92);
            color: var(--ink);
        }

        /* Forms */
        .form-control, .form-select {
            border-radius: 1rem;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.85);
            padding: 0.85rem 1rem;
            font-weight: 700;
        }

        .form-control:focus, .form-select:focus {
            border-color: rgba(14, 165, 233, 0.55);
            box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.14);
        }

        .form-label { font-weight: 800; color: var(--ink); }

        /* Mini stats */
        .mini-stat {
            padding: 0.85rem 1rem;
            border-radius: 1rem;
            border: 1px solid var(--border);
            background: rgba(2, 6, 23, 0.03);
        }

        .mini-stat__num {
            font-weight: 900;
            font-size: 1.35rem;
            letter-spacing: -0.02em;
        }

        .mini-stat__label {
            color: var(--muted);
            font-size: 0.85rem;
            font-weight: 700;
        }

        /* Stepper */
        .stepper {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .stepper .step {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.8rem;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.65);
            color: var(--muted);
            font-weight: 800;
            font-size: 0.85rem;
        }

        .stepper .step.active {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.16), rgba(20, 184, 166, 0.12));
            color: var(--ink);
            border-color: rgba(14, 165, 233, 0.25);
        }

        /* Seats */
        .seat-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 0.65rem;
        }

        .seat-item input { display: none; }

        .seat-item label {
            display: grid;
            place-items: center;
            height: 56px;
            border-radius: 1rem;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.86);
            font-weight: 900;
            cursor: pointer;
            transition: 0.15s ease;
            user-select: none;
        }

        .seat-item label:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(2, 6, 23, 0.08);
        }

        .seat-item input:checked + label {
            background: linear-gradient(135deg, var(--brand), var(--brand-2));
            border-color: rgba(14, 165, 233, 0.35);
            color: #fff;
            box-shadow: 0 18px 40px rgba(14, 165, 233, 0.26);
        }

        .seat-item label.unavailable {
            cursor: not-allowed;
            opacity: 0.62;
            transform: none !important;
            box-shadow: none !important;
        }

        .seat-item label.unavailable.booked { background: rgba(100, 116, 139, 0.18); }
        .seat-item label.unavailable.reserved { background: rgba(249, 115, 22, 0.20); }

        @media (max-width: 992px) {
            .seat-grid { grid-template-columns: repeat(5, minmax(0, 1fr)); }
        }

        @media (max-width: 576px) {
            .seat-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }

        /* Status */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.85rem;
            border-radius: 999px;
            font-weight: 900;
            font-size: 0.85rem;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.65);
            color: var(--muted);
        }

        .status-pill.confirmed {
            background: rgba(20, 184, 166, 0.12);
            border-color: rgba(20, 184, 166, 0.22);
            color: var(--success-ink);
        }

        .status-pill.pending {
            background: rgba(249, 115, 22, 0.12);
            border-color: rgba(249, 115, 22, 0.22);
            color: var(--warning-ink);
        }

        .status-pill.cancelled {
            background: rgba(251, 113, 133, 0.12);
            border-color: rgba(251, 113, 133, 0.22);
            color: var(--danger-ink);
        }

        /* Alerts */
        .alert {
            border-radius: var(--radius);
            border: 1px solid var(--border);
        }

        .alert-success {
            background: rgba(20, 184, 166, 0.10);
            border-color: rgba(20, 184, 166, 0.22);
            color: var(--success-ink);
        }

        .alert-danger {
            background: rgba(251, 113, 133, 0.10);
            border-color: rgba(251, 113, 133, 0.22);
            color: var(--danger-ink);
        }

        .alert-warning {
            background: rgba(249, 115, 22, 0.10);
            border-color: rgba(249, 115, 22, 0.22);
            color: var(--warning-ink);
        }

    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg app-navbar sticky-top">
    <div class="container py-2">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="brand-mark"><i class="bi bi-bus-front-fill"></i></span>
            <span>PO Haryanto</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list" style="font-size: 1.75rem;"></i>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}" href="{{ route('search') }}">
                        <i class="bi bi-search me-1"></i> Cari Tiket
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-ghost btn-sm" href="{{ route('admin.login') }}">
                        <i class="bi bi-shield-lock me-1"></i> Admin
                    </a>
                </li>
                @auth
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-2"><a class="btn btn-ghost btn-sm" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i> Login</a></li>
                    <li class="nav-item"><a class="btn btn-brand btn-sm" href="{{ route('register') }}"><i class="bi bi-person-plus me-1"></i> Daftar</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="py-4 py-lg-5">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>