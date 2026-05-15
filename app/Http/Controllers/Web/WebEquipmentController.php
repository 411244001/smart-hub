<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class WebEquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::latest()->get();
        return view('equipment.index', compact('equipments'));
    }

    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:available,borrowed,maintenance',
        ]);

        Equipment::create($request->all());

        return redirect()->route('equipment.index')
            ->with('success', 'Peralatan berhasil ditambahkan!');
    }

    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:available,borrowed,maintenance',
        ]);

        $equipment->update($request->all());

        return redirect()->route('equipment.index')
            ->with('success', 'Peralatan berhasil diupdate!');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipment.index')
            ->with('success', 'Peralatan berhasil dihapus!');
    }
}
