@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="surface p-4 p-lg-5">
                <div class="mb-4">
                    <div class="text-uppercase small text-muted fw-semibold">Akses admin</div>
                    <h1 class="h4 fw-bold mb-0">Login admin</h1>
                </div>
                <form method="POST" action="{{ route('admin.login.store') }}" class="row g-3">
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
                    <div class="col-12">
                        <button class="btn btn-accent btn-lg w-100"><i class="bi bi-shield-lock me-1"></i> Masuk Admin</button>
                    </div>
                </form>
                <div class="small text-secondary mt-3">Demo admin: admin@haryanto.test / password</div>
            </div>
        </div>
    </div>
@endsection