<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Trang chủ: Hiển thị laptop theo thương hiệu + sắp xếp giá
     */
    public function index(Request $request)
    {
        // Lấy toàn bộ danh mục để hiển thị trên menu
        $danhMucs = DanhMuc::all();

        // Lấy tham số lọc từ URL
        $idDanhMuc = $request->query('danh_muc');
        $sort      = $request->query('sort'); // 'asc' hoặc 'desc'

        // Xây dựng query chỉ lấy các sản phẩm có status = 1 (chưa xóa)
        $query = SanPham::with('danhMuc')->where('status', 1);

        if ($idDanhMuc) {
            $query->where('id_danh_muc', $idDanhMuc);
        }

        if ($sort === 'asc' || $sort === 'desc') {
            $query->orderBy('gia', $sort);
        }

        // Nếu không có lọc thương hiệu → chỉ lấy 20 cái mặc định
        if (!$idDanhMuc) {
            $sanPhams = $query->limit(20)->get();
        } else {
            // Có lọc thương hiệu → lấy tất cả của thương hiệu đó
            $sanPhams = $query->get();
        }

        // Danh mục đang được chọn (để highlight trên menu)
        $danhMucHienTai = $idDanhMuc ? DanhMuc::find($idDanhMuc) : null;

        return view('laptop.index', compact('sanPhams', 'danhMucs', 'danhMucHienTai', 'sort', 'idDanhMuc'));
    }

    /**
     * Tìm kiếm laptop theo từ khóa
     */
    public function timKiem(Request $request)
    {
        $danhMucs = DanhMuc::all();
        $tuKhoa   = $request->query('q', '');

        $sort = $request->query('sort');

        $sanPhams = collect();

        if ($tuKhoa !== '') {
            $query = SanPham::with('danhMuc')->where('status', 1)
                ->where(function ($q) use ($tuKhoa) {
                    $q->where('tieu_de', 'LIKE', '%' . $tuKhoa . '%')
                      ->orWhere('ten', 'LIKE', '%' . $tuKhoa . '%');
                });

            if ($sort === 'asc' || $sort === 'desc') {
                $query->orderBy('gia', $sort);
            }
            $sanPhams = $query->get();
        }

        return view('laptop.tim-kiem', compact('sanPhams', 'danhMucs', 'tuKhoa', 'sort'));
    }
}
