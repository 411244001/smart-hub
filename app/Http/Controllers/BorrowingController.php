<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Equipment;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // GET /api/borrowings - Lihat semua peminjaman
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'equipment'])->get();

        return response()->json([
            'message' => 'Data peminjaman berhasil diambil',
            'data'    => $borrowings,
        ]);
    }

    // POST /api/borrowings - Buat peminjaman baru (check-in tablet)
    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipments,id',
            'borrow_date'  => 'required|date',
            'return_date'  => 'nullable|date|after:borrow_date',
            'notes'        => 'nullable|string',
        ]);

        // Cek apakah peralatan tersedia
        $equipment = Equipment::findOrFail($request->equipment_id);
        if ($equipment->status !== 'available') {
            return response()->json([
                'message' => 'Peralatan tidak tersedia',
            ], 422);
        }

        // Buat peminjaman
        $borrowing = Borrowing::create([
            'user_id'      => $request->user()->id,
            'equipment_id' => $request->equipment_id,
            'borrow_date'  => $request->borrow_date,
            'return_date'  => $request->return_date,
            'notes'        => $request->notes,
            'status'       => 'pending',
        ]);

        // Update status peralatan menjadi borrowed
        $equipment->update(['status' => 'borrowed']);

        return response()->json([
            'message' => 'Peminjaman berhasil dibuat',
            'data'    => $borrowing->load(['user', 'equipment']),
        ], 201);
    }

    // GET /api/borrowings/{id} - Lihat 1 peminjaman
    public function show(Borrowing $borrowing)
    {
        return response()->json([
            'message' => 'Detail peminjaman',
            'data'    => $borrowing->load(['user', 'equipment']),
        ]);
    }

    // PUT /api/borrowings/{id} - Update status peminjaman
    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'status'      => 'in:pending,approved,returned,rejected',
            'return_date' => 'nullable|date',
            'notes'       => 'nullable|string',
        ]);

        $borrowing->update($request->all());

        // Kalau status returned, kembalikan status peralatan
        if ($request->status === 'returned') {
            $borrowing->equipment->update(['status' => 'available']);
        }

        return response()->json([
            'message' => 'Peminjaman berhasil diupdate',
            'data'    => $borrowing->load(['user', 'equipment']),
        ]);
    }

    // DELETE /api/borrowings/{id} - Hapus peminjaman
    public function destroy(Borrowing $borrowing)
    {
        // Kembalikan status peralatan ke available
        $borrowing->equipment->update(['status' => 'available']);
        $borrowing->delete();

        return response()->json([
            'message' => 'Peminjaman berhasil dihapus',
        ]);
    }
}
