<x-laptop-layout title="Giỏ hàng">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-0 rounded-0" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-0 rounded-0" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

<div style="padding:15px 0;">

    @if(empty($cart))
        <div style="text-align:center; padding:40px; color:#555;">
            <p style="font-size:16px;">Giỏ hàng trống!</p>
            <a href="/" class="btn btn-primary btn-sm">← Tiếp tục mua sắm</a>
        </div>
    @else

        {{-- Tiêu đề --}}
        <h5 style="text-align:center; color:#0d6efd; font-weight:bold; text-transform:uppercase; margin-bottom:10px;">
            Danh sách sản phẩm
        </h5>

        {{-- Bảng giỏ hàng --}}
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="background:#f2f2f2;">
                    <th style="border:1px solid #ddd; padding:6px 8px; text-align:center; width:40px;">STT</th>
                    <th style="border:1px solid #ddd; padding:6px 8px; text-align:left;">Tên sản phẩm</th>
                    <th style="border:1px solid #ddd; padding:6px 8px; text-align:center; width:80px;">Số lượng</th>
                    <th style="border:1px solid #ddd; padding:6px 8px; text-align:center; width:110px;">Đơn giá</th>
                    <th style="border:1px solid #ddd; padding:6px 8px; text-align:center; width:60px;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @php $tongTien = 0; $stt = 1; @endphp
                @foreach($cart as $id => $item)
                    @php $tongTien += $item['gia'] * $item['so_luong']; @endphp
                    <tr>
                        <td style="border:1px solid #ddd; padding:6px 8px; text-align:center;">{{ $stt++ }}</td>
                        <td style="border:1px solid #ddd; padding:6px 8px;">
                            <a href="{{ route('sanpham.detail', $item['id']) }}" style="text-decoration:none; color:#333;">
                                {{ $item['ten'] }}
                            </a>
                        </td>
                        <td style="border:1px solid #ddd; padding:6px 8px; text-align:center;">{{ $item['so_luong'] }}</td>
                        <td style="border:1px solid #ddd; padding:6px 8px; text-align:right;">
                            {{ number_format($item['gia'], 0, ',', '.') }}đ
                        </td>
                        <td style="border:1px solid #ddd; padding:6px 8px; text-align:center;">
                            <form action="{{ route('giohang.xoa', $item['id']) }}" method="POST"
                                  onsubmit="return confirm('Xóa sản phẩm này?')">
                                @csrf
                                <button type="submit"
                                        style="background:#dc3545; color:white; border:none; padding:3px 10px; border-radius:3px; cursor:pointer; font-size:12px;">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="border:1px solid #ddd; padding:6px 8px; text-align:right; font-weight:bold;">
                        Tổng cộng
                    </td>
                    <td style="border:1px solid #ddd; padding:6px 8px; text-align:right; font-weight:bold;">
                        {{ number_format($tongTien, 0, ',', '.') }}đ
                    </td>
                    <td style="border:1px solid #ddd;"></td>
                </tr>
            </tfoot>
        </table>

        {{-- Form đặt hàng --}}
        <form action="{{ route('giohang.dathang') }}" method="POST" style="margin-top:12px; text-align:center;">
            @csrf
            <div style="margin-bottom:8px; font-size:13px;">
                <label style="font-weight:bold; margin-right:8px;">Hình thức thanh toán</label>
                <select name="hinh_thuc_thanh_toan"
                        style="padding:4px 8px; border:1px solid #ccc; border-radius:4px; font-size:13px;">
                    <option value="0">Tiền mặt</option>
                    <option value="1">Chuyển khoản</option>
                </select>
            </div>
            <button type="submit"
                    style="background:#0d6efd; color:white; border:none; padding:8px 40px; border-radius:4px; cursor:pointer; font-weight:bold; font-size:14px; text-transform:uppercase;">
                Đặt hàng
            </button>
        </form>

    @endif
</div>

</x-laptop-layout>
