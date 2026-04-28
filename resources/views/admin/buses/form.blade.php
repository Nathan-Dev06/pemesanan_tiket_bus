@php($editing = isset($bus))
@php($currentBus = $editing ? $bus : null)
<form method="POST" action="{{ $action }}" class="row g-3">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif
    <div class="col-md-6">
        <label class="form-label">Nama bus</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $currentBus->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Plat nomor</label>
        <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number', $currentBus->plate_number ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Kelas</label>
        <input type="text" name="class_type" class="form-control" value="{{ old('class_type', $currentBus->class_type ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Kapasitas kursi</label>
        <input type="number" name="seat_capacity" class="form-control" value="{{ old('seat_capacity', $currentBus->seat_capacity ?? 30) }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Fasilitas</label>
        <textarea name="facilities" class="form-control" rows="3">{{ old('facilities', $currentBus->facilities ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="active" @selected(old('status', $currentBus->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $currentBus->status ?? 'active') === 'inactive')>Inactive</option>
        </select>
    </div>
    <div class="col-12 d-grid d-md-flex gap-2">
        <button class="btn btn-dark">Simpan</button>
        <a href="{{ route('admin.buses.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>