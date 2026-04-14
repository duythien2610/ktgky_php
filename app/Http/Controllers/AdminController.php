<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Hiển thị danh sách tất cả sản phẩm (có phân trang)
     */
    public function index(Request $r)
    {
        $query = SanPham::with('danhMuc')->where('status', 1);
        
        if ($r->has('danh_muc')) {
            $query->where('id_danh_muc', $r->danh_muc);
        }

        $sanPhams   = $query->orderBy('id', 'desc')->get();
        $categories = DanhMuc::all();
        return view('admin.index', compact('sanPhams', 'categories'));
    }

    /**
     * Hiển thị form thêm mới sản phẩm
     */
    public function create()
    {
        $danhMucs   = DanhMuc::all();
        $categories = $danhMucs;
        return view('admin.create', compact('danhMucs', 'categories'));
    }

    /**
     * Validate và lưu sản phẩm mới vào database
     */
    public function store(Request $r)
    {
        $r->validate([
            'ten'          => 'required|string|max:255',
            'tieu_de'      => 'required|string|max:255',
            'gia'          => 'required|numeric|min:0',
            'id_danh_muc'  => 'required|exists:danh_muc_laptop,id',
            'hinh_anh'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bao_hanh'     => 'nullable|string|max:100',
            'cpu'          => 'nullable|string|max:255',
            'ram'          => 'nullable|string|max:100',
            'luu_tru'      => 'nullable|string|max:100',
            'man_hinh'     => 'nullable|string|max:100',
            'chip_do_hoa'  => 'nullable|string|max:255',
            'he_dieu_hanh' => 'nullable|string|max:100',
            'pin'          => 'nullable|string|max:100',
            'khoi_luong'   => 'nullable|string|max:100',
            'bao_mat'      => 'nullable|string|max:255',
        ], [
            'ten.required'         => 'Vui lòng nhập tên sản phẩm.',
            'tieu_de.required'     => 'Vui lòng nhập tiêu đề.',
            'gia.required'         => 'Vui lòng nhập giá.',
            'gia.numeric'          => 'Giá phải là số.',
            'id_danh_muc.required' => 'Vui lòng chọn danh mục.',
            'id_danh_muc.exists'   => 'Danh mục không hợp lệ.',
            'hinh_anh.image'       => 'File phải là hình ảnh.',
            'hinh_anh.max'         => 'Hình ảnh không vượt quá 2MB.',
        ]);

        $data = $r->except(['hinh_anh', '_token']);

        if ($r->hasFile('hinh_anh')) {
            $file = $r->file('hinh_anh');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('', $fileName, 'public');
            $data['hinh_anh'] = $fileName;
        }

        $data['status'] = 1;

        SanPham::create($data);

        return redirect()->route('admin.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Hiển thị form sửa sản phẩm
     */
    public function edit($id)
    {
        $sanPham    = SanPham::where('status', 1)->findOrFail($id);
        $danhMucs   = DanhMuc::all();
        $categories = $danhMucs;
        return view('admin.edit', compact('sanPham', 'danhMucs', 'categories'));
    }

    /**
     * Cập nhật thông tin sản phẩm
     */
    public function update(Request $r, $id)
    {
        $sanPham = SanPham::where('status', 1)->findOrFail($id);

        $r->validate([
            'ten'          => 'required|string|max:255',
            'tieu_de'      => 'required|string|max:255',
            'gia'          => 'required|numeric|min:0',
            'id_danh_muc'  => 'required|exists:danh_muc_laptop,id',
            'hinh_anh'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bao_hanh'     => 'nullable|string|max:100',
            'cpu'          => 'nullable|string|max:255',
            'ram'          => 'nullable|string|max:100',
            'luu_tru'      => 'nullable|string|max:100',
            'man_hinh'     => 'nullable|string|max:100',
            'chip_do_hoa'  => 'nullable|string|max:255',
            'he_dieu_hanh' => 'nullable|string|max:100',
            'pin'          => 'nullable|string|max:100',
            'khoi_luong'   => 'nullable|string|max:100',
            'bao_mat'      => 'nullable|string|max:255',
        ], [
            'ten.required'         => 'Vui lòng nhập tên sản phẩm.',
            'tieu_de.required'     => 'Vui lòng nhập tiêu đề.',
            'gia.required'         => 'Vui lòng nhập giá.',
            'gia.numeric'          => 'Giá phải là số.',
            'id_danh_muc.required' => 'Vui lòng chọn danh mục.',
            'hinh_anh.image'       => 'File phải là hình ảnh.',
            'hinh_anh.max'         => 'Hình ảnh không vượt quá 2MB.',
        ]);

        $data = $r->except(['hinh_anh', '_token', '_method']);

        if ($r->hasFile('hinh_anh')) {
            // Xóa ảnh cũ nếu có
            if ($sanPham->hinh_anh) {
                Storage::disk('public')->delete($sanPham->hinh_anh);
            }
            $file = $r->file('hinh_anh');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('', $fileName, 'public');
            $data['hinh_anh'] = $fileName;
        }

        $sanPham->update($data);

        return redirect()->route('admin.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy($id)
    {
        $sanPham = SanPham::findOrFail($id);

        $sanPham->status = 0;
        $sanPham->save();

        return redirect()->route('admin.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
