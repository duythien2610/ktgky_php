<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'danh_muc_laptop';

    protected $fillable = ['ten_danh_muc'];

    public $timestamps = false;

    /**
     * Quan hệ: Danh mục có nhiều sản phẩm
     */
    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'id_danh_muc');
    }
}
