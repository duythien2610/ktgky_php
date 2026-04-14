<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// ===== Admin Routes =====
Route::get('/admin/san-pham', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/san-pham/them', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/san-pham/them', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/san-pham/sua/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/admin/san-pham/sua/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::post('/admin/san-pham/xoa/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
