<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; min-height: 100vh; }

        .topbar {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 0 32px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
            position: sticky; top: 0; z-index: 100;
        }
        .topbar-brand { display: flex; align-items: center; gap: 12px; color: #fff; font-size: 20px; font-weight: 700; }
        .topbar-brand span.icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #e94560, #c62a47);
            border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .topbar-btn {
            background: rgba(255,255,255,0.12); color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 13px;
            text-decoration: none; display: flex; align-items: center; gap: 6px; transition: all 0.2s;
        }
        .topbar-btn:hover { background: rgba(255,255,255,0.22); }

        .content { padding: 32px; max-width: 900px; margin: 0 auto; }

        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #6b7280; margin-bottom: 20px; }
        .breadcrumb a { color: #e94560; text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }

        .form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 1px 20px rgba(0,0,0,0.07);
            overflow: hidden;
        }
        .form-card-header {
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            padding: 24px 32px;
            color: #fff;
        }
        .form-card-header h2 { font-size: 20px; font-weight: 700; }
        .form-card-header p { font-size: 13px; color: rgba(255,255,255,0.7); margin-top: 4px; }

        .form-body { padding: 32px; }

        .section-title {
            font-size: 13px; font-weight: 600; color: #6b7280;
            text-transform: uppercase; letter-spacing: 0.05em;
            margin-bottom: 16px; padding-bottom: 10px;
            border-bottom: 1px solid #f3f4f6;
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 28px; }
        .form-grid.full { grid-template-columns: 1fr; }
        .form-grid.three { grid-template-columns: 1fr 1fr 1fr; }

        .form-group { display: flex; flex-direction: column; }
        .form-group.span2 { grid-column: span 2; }
        label { font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px; }
        label .req { color: #e94560; margin-left: 3px; }

        input[type="text"], input[type="number"], select, textarea {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #374151;
            transition: all 0.2s;
            outline: none;
            background: #fafafa;
            width: 100%;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #e94560;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(233,69,96,0.1);
        }
        textarea { resize: vertical; min-height: 80px; }

        .file-upload-wrap {
            border: 2px dashed #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #fafafa;
        }
        .file-upload-wrap:hover { border-color: #e94560; background: #fff5f6; }
        .file-upload-wrap input[type="file"] { display: none; }
        .file-upload-wrap .upload-icon { font-size: 36px; margin-bottom: 8px; }
        .file-upload-wrap p { font-size: 14px; color: #6b7280; }
        .file-upload-wrap small { font-size: 12px; color: #9ca3af; }
        #preview-img {
            max-width: 150px; max-height: 150px;
            object-fit: contain; border-radius: 10px;
            border: 1px solid #e5e7eb;
            display: none; margin: 12px auto 0;
        }

        .error-msg { color: #ef4444; font-size: 12px; margin-top: 4px; }
        .alert-error {
            background: #fef2f2; border-left: 4px solid #ef4444;
            color: #991b1b; padding: 14px 20px; border-radius: 10px;
            margin-bottom: 24px; font-size: 14px;
        }
        .alert-error ul { margin-top: 8px; padding-left: 20px; }

        .form-actions {
            display: flex; gap: 12px; justify-content: flex-end;
            padding: 24px 32px;
            border-top: 1px solid #f3f4f6;
            background: #fafafa;
        }
        .btn-cancel {
            padding: 12px 28px; border-radius: 10px;
            border: 1.5px solid #e5e7eb; background: #fff;
            color: #374151; font-size: 14px; font-weight: 500;
            text-decoration: none; cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-cancel:hover { border-color: #9ca3af; background: #f9fafb; }
        .btn-submit {
            padding: 12px 32px; border-radius: 10px;
            background: linear-gradient(135deg, #e94560, #c62a47);
            color: #fff; border: none; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(233,69,96,0.35);
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(233,69,96,0.45); }
    </style>
</head>
<body>

<div class="topbar">
    <div class="topbar-brand">
        <span class="icon">💻</span>
        Admin Panel
    </div>
    <div style="display:flex;gap:12px">
        <a href="{{ route('admin.index') }}" class="topbar-btn">← Danh sách</a>
        <a href="{{ url('/') }}" class="topbar-btn">🏠 Trang chủ</a>
    </div>
</div>

<div class="content">

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.index') }}">Sản phẩm</a>
        <span>›</span>
        <span>Thêm mới</span>
    </div>

    @if($errors->any())
        <div class="alert-error">
            <strong>⚠️ Có lỗi xảy ra:</strong>
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <div class="form-card-header">
            <h2>➕ Thêm sản phẩm mới</h2>
            <p>Điền đầy đủ thông tin bên dưới để thêm laptop vào hệ thống</p>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-body">

                <!-- Thông tin cơ bản -->
                <div class="section-title">📋 Thông tin cơ bản</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Tên sản phẩm <span class="req">*</span></label>
                        <input type="text" name="ten" value="{{ old('ten') }}" placeholder="VD: MacBook Air M2 2024" required>
                        @error('ten') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Danh mục <span class="req">*</span></label>
                        <select name="id_danh_muc" required>
                            <option value="">-- Chọn thương hiệu --</option>
                            @foreach($danhMucs as $dm)
                                <option value="{{ $dm->id }}" {{ old('id_danh_muc') == $dm->id ? 'selected' : '' }}>
                                    {{ $dm->ten_danh_muc }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_danh_muc') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group span2">
                        <label>Tiêu đề mô tả <span class="req">*</span></label>
                        <input type="text" name="tieu_de" value="{{ old('tieu_de') }}" placeholder="VD: Laptop mỏng nhẹ, hiệu năng cao, pin trâu" required>
                        @error('tieu_de') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Giá bán (VNĐ) <span class="req">*</span></label>
                        <input type="number" name="gia" value="{{ old('gia') }}" placeholder="VD: 29990000" min="0" required>
                        @error('gia') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Bảo hành</label>
                        <input type="text" name="bao_hanh" value="{{ old('bao_hanh') }}" placeholder="VD: 12 tháng">
                    </div>
                </div>

                <!-- Hình ảnh -->
                <div class="section-title">🖼️ Hình ảnh sản phẩm</div>
                <div class="form-grid full" style="margin-bottom:28px">
                    <div class="form-group">
                        <label for="hinh-anh-input">Chọn hình ảnh</label>
                        <div class="file-upload-wrap" onclick="document.getElementById('hinh-anh-input').click()">
                            <input type="file" id="hinh-anh-input" name="hinh_anh" accept="image/*"
                                   onchange="previewImage(this)">
                            <div class="upload-icon">📷</div>
                            <p>Click để chọn ảnh hoặc kéo thả vào đây</p>
                            <small>JPG, PNG, WEBP — Tối đa 2MB</small>
                            <img id="preview-img" src="" alt="Preview">
                        </div>
                        @error('hinh_anh') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Thông số kỹ thuật -->
                <div class="section-title">⚙️ Thông số kỹ thuật</div>
                <div class="form-grid three">
                    <div class="form-group">
                        <label>CPU / Bộ xử lý</label>
                        <input type="text" name="cpu" value="{{ old('cpu') }}" placeholder="VD: Apple M2, Intel Core i7">
                    </div>
                    <div class="form-group">
                        <label>RAM</label>
                        <input type="text" name="ram" value="{{ old('ram') }}" placeholder="VD: 16GB, 32GB">
                    </div>
                    <div class="form-group">
                        <label>Lưu trữ</label>
                        <input type="text" name="luu_tru" value="{{ old('luu_tru') }}" placeholder="VD: 512GB SSD, 1TB NVMe">
                    </div>
                    <div class="form-group">
                        <label>Màn hình</label>
                        <input type="text" name="man_hinh" value="{{ old('man_hinh') }}" placeholder="VD: 13.6 inch Retina">
                    </div>
                    <div class="form-group">
                        <label>Card đồ họa</label>
                        <input type="text" name="chip_do_hoa" value="{{ old('chip_do_hoa') }}" placeholder="VD: RTX 4060, Intel Iris Xe">
                    </div>
                    <div class="form-group">
                        <label>Hệ điều hành</label>
                        <input type="text" name="he_dieu_hanh" value="{{ old('he_dieu_hanh') }}" placeholder="VD: macOS, Windows 11">
                    </div>
                    <div class="form-group">
                        <label>Pin</label>
                        <input type="text" name="pin" value="{{ old('pin') }}" placeholder="VD: 52.6Wh, 18 giờ">
                    </div>
                    <div class="form-group">
                        <label>Khối lượng</label>
                        <input type="text" name="khoi_luong" value="{{ old('khoi_luong') }}" placeholder="VD: 1.24 kg">
                    </div>
                    <div class="form-group">
                        <label>Bảo mật</label>
                        <input type="text" name="bao_mat" value="{{ old('bao_mat') }}" placeholder="VD: Touch ID, Face ID">
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('admin.index') }}" class="btn-cancel">✕ Hủy</a>
                <button type="submit" class="btn-submit">💾 Lưu sản phẩm</button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const img = document.getElementById('preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
