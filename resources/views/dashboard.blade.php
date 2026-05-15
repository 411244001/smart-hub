@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Dashboard</h4>
    <span class="text-muted">Selamat datang, {{ auth()->user()->name }}!</span>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #667eea, #764ba2)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">Total Peralatan</small>
                    <h3 class="fw-bold mb-0">{{ $totalEquipment }}</h3>
                </div>
                <i class="fas fa-camera fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #f093fb, #f5576c)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">Total Peminjaman</small>
                    <h3 class="fw-bold mb-0">{{ $totalBorrowing }}</h3>
                </div>
                <i class="fas fa-clipboard-list fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #4facfe, #00f2fe)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">Total Pengguna</small>
                    <h3 class="fw-bold mb-0">{{ $totalUser }}</h3>
                </div>
                <i class="fas fa-users fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #43e97b, #38f9d7)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="opacity-75">Peralatan Tersedia</small>
                    <h3 class="fw-bold mb-0">{{ $availableEquipment }}</h3>
                </div>
                <i class="fas fa-check-circle fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Borrowings -->
<div class="card p-4">
    <h5 class="fw-bold mb-3">
        <i class="fas fa-clock me-2 text-primary"></i>Peminjaman Terbaru
    </h5>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Peminjam</th>
                    <th>Peralatan</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBorrowings as $borrowing)
                <tr>
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
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada peminjaman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection