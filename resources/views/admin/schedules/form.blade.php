@php($editing = isset($schedule))
@php($currentSchedule = $editing ? $schedule : null)
<form method="POST" action="{{ $action }}" class="row g-3">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif
    <div class="col-md-6">
        <label class="form-label">Bus</label>
        <select name="bus_id" class="form-select" required>
            @foreach ($buses as $bus)
                <option value="{{ $bus->id }}" @selected(old('bus_id', $currentSchedule->bus_id ?? '') == $bus->id)>{{ $bus->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Rute</label>
        <select name="route_id" class="form-select" required>
            @foreach ($routes as $route)
                <option value="{{ $route->id }}" @selected(old('route_id', $currentSchedule->route_id ?? '') == $route->id)>{{ $route->origin }} → {{ $route->destination }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tanggal</label>
        <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date', $currentSchedule ? $currentSchedule->departure_date->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Berangkat</label>
        <input type="time" name="departure_time" class="form-control" value="{{ old('departure_time', $currentSchedule->departure_time ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tiba</label>
        <input type="time" name="arrival_time" class="form-control" value="{{ old('arrival_time', $currentSchedule->arrival_time ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Harga</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $currentSchedule->price ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Jumlah kursi</label>
        <input type="number" name="seat_count" class="form-control" value="{{ old('seat_count', $currentSchedule->seat_count ?? 30) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="active" @selected(old('status', $currentSchedule->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $currentSchedule->status ?? 'active') === 'inactive')>Inactive</option>
        </select>
    </div>
    <div class="col-12 d-grid d-md-flex gap-2">
        <button class="btn btn-dark">Simpan</button>
        <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>