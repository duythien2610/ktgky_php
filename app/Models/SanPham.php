<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_pham';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    protected $fillable = [
        'tieu_de', 'ten', 'gia', 'hinh_anh', 'id_danh_muc',
        'bao_hanh', 'cpu', 'ram', 'luu_tru', 'man_hinh',
        'chip_do_hoa', 'he_dieu_hanh', 'pin', 'khoi_luong', 'bao_mat',
        'series_model', 'mau_sac', 'nhu_cau', 'webcam', 'cong_ket_noi',
        'ket_noi_khong_day', 'ban_phim', 'status'
    ];

    /**
     * Quan hệ: Sản phẩm thuộc một danh mục (thương hiệu)
     */
    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'id_danh_muc');
    }
}
