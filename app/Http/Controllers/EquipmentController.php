<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    // GET /api/equipments - Lihat semua peralatan
    public function index()
    {
        $equipments = Equipment::all();

        return response()->json([
            'message' => 'Data peralatan berhasil diambil',
            'data'    => $equipments,
        ]);
    }

    // POST /api/equipments - Tambah peralatan baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:available,borrowed,maintenance',
        ]);

        $equipment = Equipment::create($request->all());

        return response()->json([
            'message' => 'Peralatan berhasil ditambahkan',
            'data'    => $equipment,
        ], 201);
    }

    // GET /api/equipments/{id} - Lihat 1 peralatan
    public function show(Equipment $equipment)
    {
        return response()->json([
            'message' => 'Detail peralatan',
            'data'    => $equipment,
        ]);
    }

    // PUT /api/equipments/{id} - Edit peralatan
    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name'        => 'string|max:255',
            'category'    => 'string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:available,borrowed,maintenance',
        ]);

        $equipment->update($request->all());

        return response()->json([
            'message' => 'Peralatan berhasil diupdate',
            'data'    => $equipment,
        ]);
    }

    // DELETE /api/equipments/{id} - Hapus peralatan
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return response()->json([
            'message' => 'Peralatan berhasil dihapus',
        ]);
    }
}
