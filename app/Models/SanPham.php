<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_pham';

    protected $fillable = [
        'tieu_de', 'ten', 'gia', 'hinh_anh', 'id_danh_muc',
        'bao_hanh', 'cpu', 'ram', 'luu_tru', 'man_hinh',
        'chip_do_hoa', 'he_dieu_hanh', 'pin', 'khoi_luong', 'bao_mat',
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'id_danh_muc');
    }
}
