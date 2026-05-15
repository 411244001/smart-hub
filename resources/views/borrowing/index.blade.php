@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Daftar Peminjaman</h4>
    <a href="{{ route('borrowing.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Peminjaman
    </a>
</div>

<div class="card p-4">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Peminjam</th>
                    <th>Peralatan</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ $borrowing->equipment->name }}</td>
                    <td>{{ $borrowing->borrow_date }}</td>
                    <td>{{ $borrowing->return_date ?? '-' }}</td>
                    <td>
                        @if($borrowing->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                        @elseif($borrowing->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                        @elseif($borrowing->status == 'returned')
                        <span class="badge bg-info">Returned</span>
                        @else
                        <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        <!-- Update Status -->
                        <form action="{{ route('borrowing.update', $borrowing) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm d-inline w-auto">
                                <option value="pending" {{ $borrowing->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $borrowing->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="returned" {{ $borrowing->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                <option value="rejected" {{ $borrowing->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <!-- Hapus -->
                        <form action="{{ route('borrowing.destroy', $borrowing) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus peminjaman ini?')">
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
                    <td colspan="7" class="text-center text-muted">Belum ada peminjaman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection