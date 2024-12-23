<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public routes (no authentication required)
Route::get('/', function () {
    return view('welcome');
});

// Grouping authenticated routes with Jetstream authentication
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Default route for regular users
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin route, protected by auth middleware
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
