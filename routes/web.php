<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Người chịu trách nhiệm file này: THIÊN
| Sang & Nam sẽ gửi đoạn route cho Thiên merge vào đây sau khi code xong
|--------------------------------------------------------------------------
*/

// ===== TRANG CHỦ & TÌM KIẾM (THIÊN) =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tim-kiem', [HomeController::class, 'timKiem'])->name('tim-kiem');

// ===== CHI TIẾT SẢN PHẨM & GIỎ HÀNG (SANG) =====
// TODO: Sang thêm vào đây sau khi tạo SanPhamController
// Route::get('/san-pham/{id}', [SanPhamController::class, 'detail'])->name('sanpham.detail');
// Route::post('/gio-hang/them', [SanPhamController::class, 'themVaoGio'])->name('giohang.them');
// Route::get('/gio-hang', [SanPhamController::class, 'xemGio'])->name('giohang.index');
// Route::post('/gio-hang/xoa/{id}', [SanPhamController::class, 'xoaKhoiGio'])->name('giohang.xoa');
// Route::post('/dat-hang', [SanPhamController::class, 'datHang'])->name('giohang.dathang');

// ===== QUẢN LÝ SẢN PHẨM (NAM) =====
// TODO: Nam thêm vào đây sau khi tạo AdminController
// Route::get('/admin/san-pham', [AdminController::class, 'index'])->name('admin.index');
// Route::get('/admin/san-pham/them', [AdminController::class, 'create'])->name('admin.create');
// Route::post('/admin/san-pham/them', [AdminController::class, 'store'])->name('admin.store');
// Route::get('/admin/san-pham/sua/{id}', [AdminController::class, 'edit'])->name('admin.edit');
// Route::post('/admin/san-pham/sua/{id}', [AdminController::class, 'update'])->name('admin.update');
// Route::post('/admin/san-pham/xoa/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

// ===== DASHBOARD & PROFILE (Laravel Breeze - Không sửa) =====
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
