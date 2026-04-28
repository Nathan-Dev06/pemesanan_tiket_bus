@extends('layouts.admin')

@section('title', 'Tambah Rute')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <h1 class="h4 fw-bold mb-3">Tambah rute</h1>
        @include('admin.routes.form', ['action' => route('admin.routes.store')])
    </div>
@endsection