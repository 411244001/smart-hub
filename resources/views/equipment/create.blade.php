@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Tambah Peralatan</h4>
    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="card p-4">
    <form action="{{ route('equipment.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Peralatan</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="Contoh: Kamera Sony A7III">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                value="{{ old('category') }}" placeholder="Contoh: Kamera">
            @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"
                placeholder="Deskripsi peralatan...">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" class="form-select">
                <option value="available">Tersedia</option>
                <option value="borrowed">Dipinjam</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Simpan
        </button>
    </form>
</div>
@endsection