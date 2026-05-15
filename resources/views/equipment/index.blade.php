@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Daftar Peralatan</h4>
    <a href="{{ route('equipment.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Peralatan
    </a>
</div>

<div class="card p-4">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipments as $equipment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $equipment->name }}</td>
                    <td>{{ $equipment->category }}</td>
                    <td>{{ $equipment->description ?? '-' }}</td>
                    <td>
                        @if($equipment->status == 'available')
                        <span class="badge bg-success">Tersedia</span>
                        @elseif($equipment->status == 'borrowed')
                        <span class="badge bg-warning">Dipinjam</span>
                        @else
                        <span class="badge bg-danger">Maintenance</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('equipment.edit', $equipment) }}"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('equipment.destroy', $equipment) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus peralatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada peralatan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection