<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Equipment;
use Illuminate\Http\Request;

class WebBorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'equipment'])->latest()->get();
        return view('borrowing.index', compact('borrowings'));
    }

    public function create()
    {
        $equipments = Equipment::where('status', 'available')->get();
        return view('borrowing.create', compact('equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipments,id',
            'borrow_date'  => 'required|date',
            'return_date'  => 'nullable|date|after:borrow_date',
            'notes'        => 'nullable|string',
        ]);

        $equipment = Equipment::findOrFail($request->equipment_id);
        $equipment->update(['status' => 'borrowed']);

        Borrowing::create([
            'user_id'      => auth()->id(),
            'equipment_id' => $request->equipment_id,
            'borrow_date'  => $request->borrow_date,
            'return_date'  => $request->return_date,
            'notes'        => $request->notes,
            'status'       => 'pending',
        ]);

        return redirect()->route('borrowing.index')
            ->with('success', 'Peminjaman berhasil dibuat!');
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,returned,rejected',
        ]);

        $borrowing->update($request->all());

        if ($request->status === 'returned') {
            $borrowing->equipment->update(['status' => 'available']);
        }

        return redirect()->route('borrowing.index')
            ->with('success', 'Status peminjaman berhasil diupdate!');
    }

    public function destroy(Borrowing $borrowing)
    {
        $borrowing->equipment->update(['status' => 'available']);
        $borrowing->delete();

        return redirect()->route('borrowing.index')
            ->with('success', 'Peminjaman berhasil dihapus!');
    }
}
