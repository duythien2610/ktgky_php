<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đặt hàng thành công</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 1px solid #e0e0e0;">
        
        <!-- Header -->
        <div style="background-color: #1a2732; padding: 30px 20px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px;">LaptopStore</h1>
            <p style="color: #23b85c; margin: 10px 0 0; font-weight: bold; font-size: 16px;">ĐẶT HÀNG THÀNH CÔNG!</p>
        </div>

        <!-- Body -->
        <div style="padding: 30px 40px;">
            <p style="font-size: 16px; color: #333; line-height: 1.6;">
                Xin chào <strong>{{ Auth::user()->name ?? 'Quý khách' }}</strong>,
            </p>
            <p style="font-size: 14px; color: #666; line-height: 1.6;">
                Cảm ơn bạn đã tin tưởng và mua sắm tại <strong>LaptopStore</strong>. Đơn hàng của bạn đã nhận được và đang trong quá trình xử lý.
            </p>

            <!-- Order info -->
            <div style="margin-top: 30px; padding: 20px; background-color: #f9fafb; border-radius: 8px;">
                <h3 style="margin: 0 0 15px; font-size: 16px; color: #1a2732; border-bottom: 2px solid #1a2732; display: inline-block;">Thông tin đơn hàng</h3>
                <p style="margin: 5px 0; font-size: 14px;"><strong>Mã đơn hàng:</strong> <span style="color: #d70018;">#{{ $orderId }}</span></p>
                <p style="margin: 5px 0; font-size: 14px;"><strong>Ngày đặt:</strong> {{ date('d/m/Y H:i') }}</p>
            </div>

            <!-- Product list -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 25px;">
                <thead>
                    <tr style="border-bottom: 2px solid #eeeeee;">
                        <th style="padding: 10px 0; text-align: left; font-size: 14px; color: #1a2732;">Sản phẩm</th>
                        <th style="padding: 10px 0; text-align: center; font-size: 14px; color: #1a2732; width: 60px;">SL</th>
                        <th style="padding: 10px 0; text-align: right; font-size: 14px; color: #1a2732; width: 120px;">Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td style="padding: 15px 0; font-size: 13px; color: #333;">
                            {{ $item['ten'] }}
                        </td>
                        <td style="padding: 15px 0; text-align: center; font-size: 13px; color: #666;">
                            {{ $item['so_luong'] }}
                        </td>
                        <td style="padding: 15px 0; text-align: right; font-size: 13px; color: #333; font-weight: 600;">
                            {{ number_format($item['gia'], 0, ',', '.') }}đ
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="padding: 20px 0 0; text-align: right; font-weight: bold; font-size: 16px; color: #1a2732;">Tổng cộng:</td>
                        <td style="padding: 20px 0 0; text-align: right; font-weight: bold; font-size: 18px; color: #d70018;">
                            {{ number_format($total, 0, ',', '.') }}đ
                        </td>
                    </tr>
                </tfoot>
            </table>

            <!-- Button -->
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ url('/') }}" style="background-color: #1a2732; color: #ffffff; padding: 12px 30px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px;">Tiếp tục mua sắm</a>
            </div>
        </div>

        <!-- Footer -->
        <div style="background-color: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #eeeeee;">
            <p style="margin: 0; font-size: 12px; color: #999;">
                &copy; {{ date('Y') }} LaptopStore.vn. All rights reserved.<br>
                Địa chỉ: Quận Cam, TP. Hồ Chí Minh
            </p>
        </div>
    </div>
</body>
</html>
