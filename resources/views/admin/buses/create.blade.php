@extends('layouts.admin')

@section('title', 'Tambah Bus')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <h1 class="h4 fw-bold mb-3">Tambah bus</h1>
        @include('admin.buses.form', ['action' => route('admin.buses.store')])
    </div>
@endsection