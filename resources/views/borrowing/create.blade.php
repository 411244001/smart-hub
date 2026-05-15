@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Tambah Peminjaman</h4>
    <a href="{{ route('borrowing.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="card p-4">
    <form action="{{ route('borrowing.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Peralatan</label>
            <select name="equipment_id" class="form-select @error('equipment_id') is-invalid @enderror">
                <option value="">-- Pilih Peralatan --</option>
                @foreach($equipments as $equipment)
                <option value="{{ $equipment->id }}">
                    {{ $equipment->name }} ({{ $equipment->category }})
                </option>
                @endforeach
            </select>
            @error('equipment_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Tanggal Pinjam</label>
            <input type="date" name="borrow_date"
                class="form-control @error('borrow_date') is-invalid @enderror"
                value="{{ old('borrow_date') }}">
            @error('borrow_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Tanggal Kembali</label>
            <input type="date" name="return_date"
                class="form-control"
                value="{{ old('return_date') }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Catatan</label>
            <textarea name="notes" class="form-control" rows="3"
                placeholder="Catatan peminjaman...">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Simpan
        </button>
    </form>
</div>
@endsection