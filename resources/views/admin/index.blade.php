<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('library/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('library/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('library/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('library/popper.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">

    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; font-size: 14px; }

        .container { max-width: 1000px; margin: 0 auto; padding: 0 15px; }

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
        .auth-buttons .btn + .btn { margin-left: 10px; }
        .nav-item a { color: #fff !important; }
        .nav-item { padding: 0 5px; }
        .search-btn {
            width: 50px; height: 30px; color: black; background-color: white;
            border-radius: 30px; border: none; position: absolute; right: 0;
        }

        /* Page title */
        .page-title {
            text-align: center;
            color: #0066cc;
            font-size: 20px;
            font-weight: bold;
            margin: 16px 0 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Toolbar row */
        .toolbar-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }
        .btn-them-moi {
            background-color: #28a745; color: #fff;
            padding: 6px 16px; border-radius: 4px;
            text-decoration: none; font-size: 14px; font-weight: 600;
            border: none; cursor: pointer;
        }
        .btn-them-moi:hover { background-color: #218838; color: #fff; text-decoration: none; }

        /* Alert */
        .alert-success-custom {
            background: #d4edda; border: 1px solid #c3e6cb; color: #155724;
            padding: 10px 16px; border-radius: 4px; margin-bottom: 12px; font-size: 14px;
        }

        /* Table */
        .table-wrapper { background: #fff; }
        #san-pham-table th { cursor: pointer; white-space: nowrap; }
        #san-pham-table td { vertical-align: middle; }
        #san-pham-table td img { width: 50px; height: 40px; object-fit: contain; }

        .btn-xem  { background: #007bff; color: #fff; padding: 4px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; margin-right: 4px; }
        .btn-xem:hover  { background: #0069d9; color: #fff; text-decoration: none; }
        .btn-xoa  { background: #dc3545; color: #fff; padding: 4px 12px; border-radius: 4px; font-size: 13px; border: none; cursor: pointer; }
        .btn-xoa:hover  { background: #c82333; }
    </style>
</head>
<body>

{{-- ===== HEADER (giống trang chủ) ===== --}}
<header>
    <div style="text-align:center; max-width:1000px; margin:0 auto">
        <img src="{{ asset('images/banner.png') }}" width="1000px">
        <nav class="navbar navbar-light navbar-expand-sm">
            <div class="container-fluid p-0">
                <div class="col-6 p-0">
                    <ul class="navbar-nav">
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('laptop/theloai/'.$category->id) }}">
                                    {{ $category->ten_danh_muc }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="search-bar">
                    <form method="post" action="{{ url('/timkiem') }}">
                        @csrf
                        <input type="text" name="keyword" placeholder="Tìm kiếm laptop...">
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
                <div class="col-2 p-0 d-flex">
                    @auth
                        <div class="dropdown">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.index') }}">Quản lý</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">Đăng xuất</a>
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

{{-- ===== CONTENT ===== --}}
<main class="container" style="margin-top: 10px;">

    <h2 class="page-title">Quản lý sản phẩm</h2>

    @if(session('success'))
        <div class="alert-success-custom">✅ {{ session('success') }}</div>
    @endif

    <div class="toolbar-row">
        <a href="{{ route('admin.create') }}" class="btn-them-moi">+ Thêm mới</a>
    </div>

    <div class="table-wrapper">
        <table id="san-pham-table" class="table table-bordered table-striped table-hover" style="width:100%">
            <thead class="thead-light">
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
                    <td>{{ $sp->tieu_de }}</td>
                    <td>{{ $sp->cpu }}</td>
                    <td>{{ $sp->ram }}</td>
                    <td>{{ $sp->luu_tru }}</td>
                    <td>{{ $sp->khoi_luong }}</td>
                    <td>{{ $sp->danhMuc ? $sp->danhMuc->ten_danh_muc : '—' }}</td>
                    <td>{{ number_format($sp->gia, 2) }}</td>
                    <td>
                        @if($sp->hinh_anh)
                            <img src="{{ asset('storage/' . $sp->hinh_anh) }}" alt="{{ $sp->ten }}">
                        @else
                            <span style="color:#aaa">—</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.edit', $sp->id) }}" class="btn-xem">Xem</a>
                        <form action="{{ route('admin.destroy', $sp->id) }}" method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                            @csrf
                            <button type="submit" class="btn-xoa">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main>

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
