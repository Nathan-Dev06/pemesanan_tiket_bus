@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <h1 class="h4 fw-bold mb-3">Tambah jadwal</h1>
        @include('admin.schedules.form', ['action' => route('admin.schedules.store'), 'buses' => $buses, 'routes' => $routes])
    </div>
@endsection