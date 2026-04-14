<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'LaptopStore' }}</title>

    <link rel="stylesheet" href="{{ asset('library/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="{{ asset('library/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('library/popper.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap.bundle.min.js') }}"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
            background: #f5f6fa;
        }

        .container-main {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* ===== NAVBAR ===== */
        .navbar-top {
            background-color: #122333;
            padding: 5px 0;
        }
        .navbar-top .brand-name {
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            text-decoration: none;
        }
        .navbar-top .brand-name span { color: #23b85c; }

        .search-bar {
            flex: 1;
            max-width: 400px;
            margin: 0 20px;
            position: relative;
        }
        .search-bar input {
            width: 100%;
            padding: 5px 45px 5px 12px;
            border: none;
            border-radius: 20px;
            background-color: white;
            font-size: 0.88rem;
        }
        .search-btn {
            width: 38px;
            height: 100%;
            color: #333;
            background-color: white;
            border-radius: 0 20px 20px 0;
            border: none;
            position: absolute;
            right: 0;
            top: 0;
            cursor: pointer;
        }

        /* Cart icon */
        .cart-wrap {
            position: relative;
            color: white;
            cursor: pointer;
        }
        .cart-wrap a { color: white; }
        #cart-number-product {
            width: 20px;
            height: 20px;
            background-color: #e94560;
            font-size: 11px;
            border-radius: 50%;
            position: absolute;
            right: -2px;
            top: -4px;
            text-align: center;
            line-height: 20px;
            font-weight: bold;
        }

        /* Brand menu */
        .brand-menu {
            background: #0f3460;
        }
        .brand-menu .nav-link {
            color: #ccc !important;
            font-size: 0.85rem;
            padding: 6px 14px !important;
            border-radius: 20px;
            transition: all 0.2s;
        }
        .brand-menu .nav-link:hover,
        .brand-menu .nav-link.active-brand {
            color: #fff !important;
            background: #e94560;
        }

        /* Sort bar */
        .sort-bar {
            background: #fff;
            border-bottom: 1px solid #ddd;
            padding: 8px 0;
            margin-bottom: 10px;
        }
        .btn-sort {
            border-radius: 20px;
            font-size: 0.82rem;
            padding: 4px 14px;
            border: 1.5px solid #0f3460;
            color: #0f3460;
            background: #fff;
            margin-right: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }
        .btn-sort:hover,
        .btn-sort.active {
            background: #0f3460;
            color: #fff;
            text-decoration: none;
        }

        /* ===== LAPTOP GRID (class chuẩn theo yêu cầu đề) ===== */
        .list-laptop {
            display: grid;
            grid-template-columns: repeat(5, 20%);
        }

        .laptop {
            margin: 10px;
            text-align: center;
            border-radius: 5px;
            border: 1px solid #dbdbdb;
            overflow: hidden;
            cursor: pointer;
            background: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .laptop:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .laptop a {
            color: black;
            text-decoration: none;
        }
        .laptop img {
            width: 100%;
            height: 140px;
            object-fit: contain;
            background: #f8f9fa;
            padding: 8px;
        }

        /* laptop-info: theo đề bài (class: laptop-info) */
        .laptop-info {
            padding: 8px;
            border-top: 1px solid #f0f0f0;
        }
        .laptop-info .laptop-title {
            font-size: 0.78rem;
            color: #333;
            line-height: 1.35;
            height: 2.7em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 5px;
            text-align: left;
        }
        .laptop-info .laptop-price {
            color: #e94560;
            font-weight: 700;
            font-size: 0.9rem;
            text-align: left;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #888;
        }
        .empty-state i { font-size: 2.5rem; margin-bottom: 12px; display: block; }

        footer {
            background: #122333;
            color: #aaa;
            text-align: center;
            padding: 16px;
            margin-top: 30px;
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .list-laptop { grid-template-columns: repeat(2, 50%); }
        }
        @media (max-width: 480px) {
            .list-laptop { grid-template-columns: repeat(1, 100%); }
        }
    </style>
</head>
<body>

{{-- ===== BANNER ===== --}}
<div style="text-align:center; max-width:1000px; margin:0 auto;">
    <img src="{{ asset('images/banner.png') }}" style="width:100%; max-height:120px; object-fit:cover;">
</div>

{{-- ===== NAVBAR TOP ===== --}}
<div class="navbar-top">
    <div class="container-main">
        <nav style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px;">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="brand-name">
                <i class="fa fa-laptop"></i> Laptop<span>Store</span>
            </a>

            {{-- Tìm kiếm --}}
            <div class="search-bar">
                <form method="GET" action="{{ url('/tim-kiem') }}">
                    <input type="text" name="q" placeholder="Tìm kiếm laptop..." value="{{ request('q') }}">
                    <button type="submit" class="search-btn">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

            {{-- Giỏ hàng --}}
            <div class="cart-wrap me-2">
                @php $soLuongGio = collect(session('cart', []))->sum('so_luong'); @endphp
                <div id="cart-number-product">{{ $soLuongGio }}</div>
                <a href="{{ url('/gio-hang') }}">
                    <i class="fa fa-cart-arrow-down fa-2x"></i>
                </a>
            </div>

            {{-- Auth --}}
            <div style="display:flex; align-items:center; gap:6px;">
                @auth
                    <div class="dropdown">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/admin/san-pham') }}">
                                <i class="fa fa-cog"></i> Quản lý
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa fa-sign-out"></i> Đăng xuất
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}">
                        <button class="btn btn-sm btn-primary">Đăng nhập</button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button class="btn btn-sm btn-success">Đăng ký</button>
                    </a>
                @endauth
            </div>

        </nav>
    </div>
</div>

{{-- ===== MENU THƯƠNG HIỆU ===== --}}
<div class="brand-menu">
    <div class="container-main">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ !request('danh_muc') ? 'active-brand' : '' }}"
                   href="{{ url('/') }}">
                    <i class="fa fa-home"></i> Tất cả
                </a>
            </li>
            @if(isset($danhMucs))
                @foreach($danhMucs as $dm)
                    <li class="nav-item">
                        <a class="nav-link {{ request('danh_muc') == $dm->id ? 'active-brand' : '' }}"
                           href="{{ url('/') }}?danh_muc={{ $dm->id }}">
                            {{ $dm->ten_danh_muc }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>

{{-- ===== NỘI DUNG CHÍNH ===== --}}
<main class="container-main">
    {{ $slot }}
</main>

<footer>
    &copy; {{ date('Y') }} LaptopStore — Hệ thống cửa hàng Laptop uy tín hàng đầu
</footer>

</body>
</html>