@php($editing = isset($routeData))
@php($currentRoute = $editing ? $routeData : null)
<form method="POST" action="{{ $action }}" class="row g-3">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif
    <div class="col-md-6">
        <label class="form-label">Asal</label>
        <input type="text" name="origin" class="form-control" value="{{ old('origin', $currentRoute->origin ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tujuan</label>
        <input type="text" name="destination" class="form-control" value="{{ old('destination', $currentRoute->destination ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Transit points</label>
        <input type="text" name="transit_points" class="form-control" value="{{ old('transit_points', $currentRoute->transit_points ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $currentRoute->description ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Aktif</label>
        <select name="active" class="form-select" required>
            <option value="1" @selected((string) old('active', $currentRoute->active ?? true) === '1')>Ya</option>
            <option value="0" @selected((string) old('active', $currentRoute->active ?? true) === '0')>Tidak</option>
        </select>
    </div>
    <div class="col-12 d-grid d-md-flex gap-2">
        <button class="btn btn-dark">Simpan</button>
        <a href="{{ route('admin.routes.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>