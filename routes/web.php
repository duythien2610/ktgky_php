<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SanPhamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/san-pham/{id}', [SanPhamController::class, 'detail'])->name('sanpham.detail');
Route::post('/gio-hang/them', [SanPhamController::class, 'themVaoGio'])->name('giohang.them');
Route::get('/gio-hang', [SanPhamController::class, 'xemGio'])->name('giohang.index');
Route::post('/gio-hang/xoa/{id}', [SanPhamController::class, 'xoaKhoiGio'])->name('giohang.xoa');
Route::post('/dat-hang', [SanPhamController::class, 'datHang'])->name('giohang.dathang');

require __DIR__.'/auth.php';
