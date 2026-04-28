@extends('layouts.app')

@section('title', 'Register Pengguna')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="surface p-4 p-lg-5">
                <div class="mb-4">
                    <div class="text-uppercase small text-muted fw-semibold">Akun penumpang</div>
                    <h1 class="h4 fw-bold mb-0">Buat akun</h1>
                </div>
                <form method="POST" action="{{ route('register.store') }}" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
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
                    <div class="col-12">
                        <label class="form-label">Konfirmasi password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-brand btn-lg w-100"><i class="bi bi-person-plus me-1"></i> Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection