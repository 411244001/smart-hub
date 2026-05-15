<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Borrowing;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEquipment  = Equipment::count();
        $totalBorrowing  = Borrowing::count();
        $totalUser       = User::count();
        $availableEquipment = Equipment::where('status', 'available')->count();
        $recentBorrowings   = Borrowing::with(['user', 'equipment'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalEquipment',
            'totalBorrowing',
            'totalUser',
            'availableEquipment',
            'recentBorrowings'
        ));
    }
}
