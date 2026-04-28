@extends('layouts.admin')

@section('title', 'Data Transaksi')

@section('content')
    <div class="admin-card bg-white p-4 p-lg-5">
        <h1 class="h4 fw-bold mb-3">Data transaksi</h1>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr><th>Ref</th><th>Booking</th><th>Metode</th><th>Status</th><th>Verifikasi</th></tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->reference_number }}</td>
                            <td>{{ $transaction->booking->booking_code }}</td>
                            <td>{{ strtoupper(str_replace('_', ' ', $transaction->payment_method)) }}</td>
                            <td>{{ strtoupper($transaction->status) }}</td>
                            <td>
                                <form action="{{ route('admin.transactions.verify', $transaction) }}" method="POST" class="d-flex gap-2 flex-wrap">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm w-auto">
                                        <option value="pending" @selected($transaction->status === 'pending')>Pending</option>
                                        <option value="lunas" @selected($transaction->status === 'lunas')>Lunas</option>
                                        <option value="dibatalkan" @selected($transaction->status === 'dibatalkan')>Dibatalkan</option>
                                    </select>
                                    <button class="btn btn-sm btn-dark">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection