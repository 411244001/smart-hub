<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\WebEquipmentController;
use App\Http\Controllers\Web\WebBorrowingController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Auth::routes();

// Protected Web Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Equipment
    Route::resource('equipment', WebEquipmentController::class);

    // Borrowing
    Route::resource('borrowing', WebBorrowingController::class);
});
