<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('library/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">

    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; font-size: 14px; background-color: #f8f9fa; }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 15px; }

        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 5px 0; background-color: #122333;
            max-width: 1000px; font-weight: bold; margin: 0 auto;
        }
        .search-bar { flex: 1; max-width: 500px; margin: 0 30px; position: relative; }
        .search-bar input {
            width: 100%; padding: 5px 10px; border: none;
            border-radius: 20px; background-color: white;
        }
        .nav-item a { color: #fff !important; }
        .nav-item { padding: 0 5px; }
        .search-btn {
            width: 50px; height: 30px; color: black; background-color: white;
            border-radius: 30px; border: none; position: absolute; right: 0;
        }

        .page-title {
            text-align: center;
            color: #0066cc;
            font-size: 20px;
            font-weight: bold;
            margin: 16px 0 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .toolbar-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        .btn-them-moi {
            background-color: #28a745; color: #fff;
            padding: 8px 20px; border-radius: 4px;
            text-decoration: none; font-size: 14px; font-weight: 600;
            border: none; cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-them-moi:hover { background-color: #218838; color: #fff; text-decoration: none; }

        /* Table */
        .table-wrapper { background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 1px 10px rgba(0,0,0,0.05); }
        #san-pham-table th { cursor: pointer; white-space: nowrap; font-size: 13px; background: #f1f3f5; }
        #san-pham-table td { vertical-align: middle; font-size: 13px; }
        #san-pham-table td img { width: 50px; height: 40px; object-fit: contain; }

        .btn-xem  { background: #007bff; color: #fff; padding: 4px 10px; border-radius: 4px; text-decoration: none; font-size: 12px; margin-right: 4px; display: inline-block; }
        .btn-xem:hover  { background: #0069d9; color: #fff; text-decoration: none; }
        .btn-xoa  { background: #dc3545; color: #fff; padding: 4px 10px; border-radius: 4px; font-size: 12px; border: none; cursor: pointer; display: inline-block; }
        .btn-xoa:hover  { background: #c82333; }
        
        .price-text { font-weight: bold; color: #d70018; }
    </style>
</head>
<body>

<header>
    <div style="text-align:center; max-width:1000px; margin:0 auto">
        <img src="{{ asset('images/banner.png') }}" width="1000px">
        <nav class="navbar navbar-light navbar-expand-sm">
            <div class="container-fluid p-0">
                <div class="col-6 p-0">
                    <ul class="navbar-nav">
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index', ['danh_muc' => $category->id]) }}">
                                    {{ $category->ten_danh_muc }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="search-bar">
                    <form method="GET" action="{{ route('tim-kiem') }}">
                        <input type="text" name="q" placeholder="Tìm kiếm laptop..." value="{{ request('q') }}">
                        <button class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <div style="color:white; position:relative" class="mr-2">
                    <div style="width:20px; height:20px; background-color:#23b85c; font-size:12px;
                                border:none; border-radius:50%; position:absolute; right:2px; top:-2px" id="cart-number-product">
                        @if(session('cart')) {{ count(session('cart')) }} @else 0 @endif
                    </div>
                    <a href="{{ url('/gio-hang') }}" style="cursor:pointer; color:white;">
                        <i class="fa fa-cart-arrow-down fa-2x mr-2 mt-1" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-3 p-0 d-flex justify-content-end align-items-center">
                    @auth
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-light dropdown-toggle btn-sm" data-toggle="dropdown" style="font-weight: 600;">
                                <i class="fa fa-user-circle"></i> {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right shadow border-0" style="font-size: 13px;">
                                <div class="dropdown-header">Tài khoản</div>
                                <a class="dropdown-item" href="{{ route('admin.index') }}"><i class="fa fa-dashboard mr-2"></i> Quản lý</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item text-danger" onclick="event.preventDefault(); this.closest('form').submit();" style="cursor: pointer;">
                                        <i class="fa fa-sign-out mr-2"></i> Đăng xuất
                                    </a>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"><button class="btn btn-sm btn-primary">Đăng nhập</button></a>&nbsp;
                        <a href="{{ route('register') }}"><button class="btn btn-sm btn-success">Đăng ký</button></a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</header>

<main class="container" style="margin-top: 15px;">
    <h2 class="page-title">QUẢN LÝ SẢN PHẨM</h2>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="toolbar-row">
        <a href="{{ route('admin.create') }}" class="btn-them-moi"><i class="fa fa-plus"></i> Thêm mới</a>
    </div>

    <div class="table-wrapper">
        <table id="san-pham-table" class="table table-bordered table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>CPU</th>
                    <th>RAM</th>
                    <th>Ổ cứng</th>
                    <th>Khối lượng</th>
                    <th>Nhu cầu</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th style="min-width:110px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sanPhams as $sp)
                <tr>
                    <td style="max-width:200px">
                        <a href="{{ route('admin.edit', $sp->id) }}" style="color: #333; font-weight: 500; text-decoration: none;" title="Chỉnh sửa sản phẩm">
                            {{ $sp->tieu_de }}
                        </a>
                    </td>
                    <td>{{ $sp->cpu }}</td>
                    <td>{{ $sp->ram }}</td>
                    <td>{{ $sp->luu_tru }}</td>
                    <td>{{ $sp->khoi_luong }}</td>
                    <td>
                        @if($sp->danhMuc)
                            <a href="{{ route('admin.index', ['danh_muc' => $sp->id_danh_muc]) }}" class="badge badge-info" style="text-decoration: none;">
                                {{ $sp->danhMuc->ten_danh_muc }}
                            </a>
                        @else
                            —
                        @endif
                    </td>
                    <td><span class="price-text">{{ number_format($sp->gia, 0, ',', '.') }}đ</span></td>
                    <td class="text-center">
                        @if($sp->hinh_anh)
                            <img src="{{ asset('storage/' . $sp->hinh_anh) }}" alt="laptop" style="width: 70px; height: 50px; object-fit: contain; border: 1px solid #ddd; padding: 2px; background: #fff;">
                        @else
                            <i class="fa fa-image text-muted"></i>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                            <a href="{{ route('sanpham.detail', $sp->id) }}" class="btn-xem">Xem</a>
                            <form action="{{ route('admin.destroy', $sp->id) }}" method="POST"
                                   style="margin: 0;"
                                   onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                @csrf
                                <button type="submit" class="btn-xoa">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

{{-- Scripts --}}
<script src="{{ asset('library/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('library/popper.min.js') }}"></script>
<script src="{{ asset('library/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>

<script>
    $(document).ready(function () {
        $('#san-pham-table').DataTable({
            language: {
                lengthMenu: '_MENU_ entries per page',
                search: 'Search:',
                info: 'Hiển thị _START_ đến _END_ trong _TOTAL_ sản phẩm',
                paginate: { previous: '‹', next: '›' },
                zeroRecords: 'Không tìm thấy sản phẩm nào',
                emptyTable: 'Chưa có sản phẩm nào'
            },
            pageLength: 10,
            order: [],
            columnDefs: [{ orderable: false, targets: [7, 8] }]
        });
    });
</script>

</body>
</html>
