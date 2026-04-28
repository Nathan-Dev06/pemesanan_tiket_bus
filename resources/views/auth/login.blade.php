@extends('layouts.app')

@section('title', 'Login Pengguna')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="surface p-4 p-lg-5">
                <div class="mb-4">
                    <div class="text-uppercase small text-muted fw-semibold">Akun penumpang</div>
                    <h1 class="h4 fw-bold mb-0">Login</h1>
                </div>
                <form method="POST" action="{{ route('login.store') }}" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <a href="{{ route('register') }}" class="small text-decoration-none">Buat akun</a>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-brand btn-lg w-100"><i class="bi bi-box-arrow-in-right me-1"></i> Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection