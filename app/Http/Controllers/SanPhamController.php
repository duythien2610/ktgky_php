<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;

class SanPhamController extends Controller
{
    // Hiển thị trang chi tiết sản phẩm
    public function detail($id)
    {
        $sp = SanPham::where('status', 1)->findOrFail($id);
        return view('sanpham.detail', compact('sp'));
    }

    // Thêm sản phẩm vào giỏ hàng (session)
    public function themVaoGio(Request $r)
    {
        $id = $r->id_sp;
        $soLuong = max(1, (int)$r->so_luong);

        $sp = SanPham::where('status', 1)->findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['so_luong'] += $soLuong;
        } else {
            $cart[$id] = [
                'id'       => $sp->id,
                'ten'      => $sp->ten,
                'gia'      => $sp->gia,
                'so_luong' => $soLuong,
                'hinh_anh' => $sp->hinh_anh,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // Xem giỏ hàng
    public function xemGio()
    {
        $cart = session()->get('cart', []);
        return view('giohang.index', compact('cart'));
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function xoaKhoiGio($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('giohang.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    // Đặt hàng: lưu vào DB, xóa cart
    public function datHang(Request $r)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('giohang.index')->with('error', 'Giỏ hàng trống!');
        }

        // Tạo đơn hàng
        $maDonHang = DB::table('don_hang')->insertGetId([
            'ngay_dat_hang'        => now(),
            'tinh_trang'           => 0,
            'hinh_thuc_thanh_toan' => $r->hinh_thuc_thanh_toan ?? 0,
            'user_id'              => Auth::id() ?? 0,
        ]);

        // Thêm chi tiết đơn hàng & Tính tổng cộng
        $tongTien = 0;
        foreach ($cart as $item) {
            $tongTien += $item['gia'] * $item['so_luong'];
            DB::table('chi_tiet_don_hang')->insert([
                'ma_don_hang' => $maDonHang,
                'laptop_id'   => $item['id'],
                'so_luong'    => $item['so_luong'],
                'don_gia'     => $item['gia'],
            ]);
        }

        // Gửi email xác nhận (nếu có user đăng nhập và có email)
        if (Auth::check() && Auth::user()->email) {
            try {
                Mail::to(Auth::user()->email)->send(new OrderSuccessMail($maDonHang, $cart, $tongTien));
            } catch (\Exception $e) {
                // Log error hoặc bỏ qua để không làm gián đoạn luồng đặt hàng
                \Log::error("Email sending failed: " . $e->getMessage());
            }
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        return redirect()->route('giohang.index')->with('success', 'Đặt hàng thành công! Một email xác nhận đã được gửi đến bạn. Mã đơn hàng: #' . $maDonHang);
    }
}
