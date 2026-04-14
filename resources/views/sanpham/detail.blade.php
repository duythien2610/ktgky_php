<x-laptop-layout :title="$sp->tieu_de ?? $sp->ten">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-0 rounded-0" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

<div style="padding: 15px 0;">

    {{-- Khu vực chính: ảnh trái, info phải --}}
    <div style="display:flex; gap:20px; align-items:flex-start; border-bottom:1px solid #ddd; padding-bottom:15px; margin-bottom:15px;">

        {{-- Ảnh sản phẩm --}}
        <div style="flex:0 0 260px; text-align:center;">
            <img src="/images/{{ $sp->hinh_anh }}"
                 alt="{{ $sp->ten }}"
                 style="max-width:260px; max-height:200px; object-fit:contain;"
                 onerror="this.src='https://via.placeholder.com/260x200?text=No+Image'">
        </div>

        {{-- Thông tin sản phẩm --}}
        <div style="flex:1; font-size:13px; line-height:1.8;">
            <h5 style="font-size:16px; font-weight:bold; margin-bottom:8px;">{{ $sp->tieu_de ?? $sp->ten }}</h5>

            @if($sp->cpu)
            <div><strong>CPU:</strong> {{ $sp->cpu }}</div>
            @endif
            @if($sp->ram)
            <div><strong>RAM:</strong> {{ $sp->ram }}</div>
            @endif
            @if($sp->luu_tru)
            <div><strong>Ổ cứng:</strong> {{ $sp->luu_tru }}</div>
            @endif
            @if($sp->chip_do_hoa)
            <div><strong>Chip đồ họa:</strong> {{ $sp->chip_do_hoa }}</div>
            @endif
            @if($sp->nhu_cau)
            <div><strong>Nhu cầu:</strong> {{ $sp->nhu_cau }}</div>
            @endif
            @if($sp->man_hinh)
            <div><strong>Màn hình:</strong> {{ $sp->man_hinh }}</div>
            @endif
            @if($sp->he_dieu_hanh)
            <div><strong>Hệ điều hành:</strong> {{ $sp->he_dieu_hanh }}</div>
            @endif

            <div style="margin-top:8px;">
                <strong>Giá: </strong>
                <span style="color:red; font-weight:bold; font-size:15px;">
                    {{ number_format($sp->gia, 0, ',', '.') }} VNĐ
                </span>
            </div>

            {{-- Form thêm vào giỏ hàng --}}
            <form action="{{ route('giohang.them') }}" method="POST" style="margin-top:10px; display:flex; align-items:center; gap:8px;">
                @csrf
                <input type="hidden" name="id_sp" value="{{ $sp->id }}">
                <label style="font-weight:bold; white-space:nowrap;">Số lượng mua:</label>
                <input type="number" name="so_luong" value="1" min="1" max="99"
                       style="width:60px; padding:3px 6px; border:1px solid #ccc; border-radius:4px;">
                <button type="submit"
                        style="background:#0d6efd; color:white; border:none; padding:5px 16px; border-radius:4px; cursor:pointer; font-size:13px;">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>

    {{-- Thông tin khác --}}
    @if($sp->khoi_luong || $sp->webcam || $sp->pin || $sp->ket_noi_khong_day || $sp->ban_phim || $sp->cong_ket_noi)
    <div style="font-size:13px; line-height:1.9;">
        <h6 style="font-weight:bold; font-size:15px; margin-bottom:6px;">Thông tin khác</h6>
        @if($sp->khoi_luong)
        <div><strong>Khối lượng:</strong> {{ $sp->khoi_luong }}</div>
        @endif
        @if($sp->webcam)
        <div><strong>Webcam:</strong> {{ $sp->webcam }}</div>
        @endif
        @if($sp->pin)
        <div><strong>Pin:</strong> {{ $sp->pin }}</div>
        @endif
        @if($sp->ket_noi_khong_day)
        <div><strong>Kết nối không dây:</strong> {{ $sp->ket_noi_khong_day }}</div>
        @endif
        @if($sp->ban_phim)
        <div><strong>Bàn phím:</strong> {{ $sp->ban_phim }}</div>
        @endif
        @if($sp->cong_ket_noi)
        <div><strong>Cổng kết nối:</strong> {!! $sp->cong_ket_noi !!}</div>
        @endif
        @if($sp->bao_mat)
        <div><strong>Bảo mật:</strong> {{ $sp->bao_mat }}</div>
        @endif
    </div>
    @endif

</div>

</x-laptop-layout>
