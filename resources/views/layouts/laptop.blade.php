<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }}LaptopStore</title>

    {{-- Bootstrap CSS (có sẵn trong public/library) --}}
    <link rel="stylesheet" href="/library/bootstrap.min.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="/library/font-awesome.min.css">

    <style>
        /* ===== RESET & BASE ===== */
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f6fa; margin: 0; }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            box-shadow: 0 2px 15px rgba(0,0,0,0.3);
            padding: 0;
        }
        .navbar-brand-custom {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff !important;
            letter-spacing: 1px;
        }
        .navbar-brand-custom span { color: #e94560; }

        /* Menu thương hiệu */
        .brand-menu { background: #0f3460; padding: 6px 0; }
        .brand-menu .nav-link {
            color: #ccc !important;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 4px 14px !important;
            border-radius: 20px;
            transition: all 0.2s;
        }
        .brand-menu .nav-link:hover,
        .brand-menu .nav-link.active {
            color: #fff !important;
            background: #e94560;
        }

        /* Giỏ hàng icon */
        .cart-icon {
            position: relative;
            color: #fff !important;
            font-size: 1.2rem;
            padding: 6px 10px;
            transition: color 0.2s;
        }
        .cart-icon:hover { color: #e94560 !important; }
        .cart-badge {
            position: absolute;
            top: 0; right: 0;
            background: #e94560;
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            width: 18px; height: 18px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        /* Thanh tìm kiếm */
        .search-form { display: flex; align-items: center; gap: 6px; }
        .search-form input {
            border-radius: 20px;
            border: 1px solid #444;
            background: rgba(255,255,255,0.1);
            color: #fff;
            padding: 5px 14px;
            font-size: 0.88rem;
            outline: none;
            width: 220px;
            transition: all 0.3s;
        }
        .search-form input::placeholder { color: #aaa; }
        .search-form input:focus { background: rgba(255,255,255,0.2); border-color: #e94560; }
        .search-form button {
            background: #e94560;
            border: none;
            color: #fff;
            border-radius: 20px;
            padding: 5px 14px;
            cursor: pointer;
            font-size: 0.88rem;
            transition: background 0.2s;
        }
        .search-form button:hover { background: #c73652; }

        /* Sort buttons */
        .sort-bar {
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 0;
        }
        .sort-bar .btn-sort {
            border-radius: 20px;
            font-size: 0.85rem;
            padding: 5px 16px;
            border: 1.5px solid #0f3460;
            color: #0f3460;
            background: #fff;
            margin-right: 8px;
            transition: all 0.2s;
        }
        .sort-bar .btn-sort:hover,
        .sort-bar .btn-sort.active {
            background: #0f3460;
            color: #fff;
        }
        .sort-bar .title-bar { font-weight: 600; color: #333; font-size: 1rem; }

        /* ===== LAPTOP GRID ===== */
        .list-laptop {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            padding: 24px 0;
        }

        .laptop {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .laptop:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.13);
            text-decoration: none;
            color: inherit;
        }
        .laptop img {
            width: 100%;
            height: 165px;
            object-fit: contain;
            background: #f8f9fa;
            padding: 10px;
        }
        .laptop-info {
            padding: 12px;
            border-top: 1px solid #f0f0f0;
        }
        .laptop-info .laptop-title {
            font-size: 0.83rem;
            color: #333;
            font-weight: 500;
            line-height: 1.4;
            height: 2.8em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 8px;
        }
        .laptop-info .laptop-price {
            font-size: 1.05rem;
            font-weight: 700;
            color: #e94560;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }
        .empty-state i { font-size: 3rem; margin-bottom: 16px; display: block; }

        /* Footer */
        footer {
            background: #1a1a2e;
            color: #aaa;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand-custom navbar-brand" href="/">
            <i class="fa fa-laptop"></i> Laptop<span>Store</span>
        </a>

        {{-- Toggle mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon" style="filter: brightness(10)"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Tìm kiếm --}}
            <form class="search-form ms-auto me-3" action="{{ url('/tim-kiem') }}" method="GET">
                <input type="text" name="q" placeholder="Tìm kiếm laptop..." value="{{ request('q') }}">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>

            {{-- Giỏ hàng --}}
            <a href="{{ url('/gio-hang') }}" class="cart-icon">
                <i class="fa fa-shopping-cart fa-lg"></i>
                @php $soLuongGio = collect(session('cart', []))->sum('so_luong'); @endphp
                @if($soLuongGio > 0)
                    <span class="cart-badge">{{ $soLuongGio }}</span>
                @endif
            </a>

            {{-- Auth --}}
            <div class="ms-3">
                @auth
                    <span class="text-white me-2" style="font-size:0.85rem">
                        <i class="fa fa-user-circle"></i> {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light" style="border-radius:20px; font-size:0.8rem">
                            Đăng xuất
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light me-1" style="border-radius:20px; font-size:0.8rem">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-sm" style="border-radius:20px; font-size:0.8rem; background:#e94560; color:#fff; border:none;">Đăng ký</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- ===== MENU THƯƠNG HIỆU ===== --}}
<div class="brand-menu">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ !request('danh_muc') ? 'active' : '' }}"
                   href="{{ url('/') }}">
                    <i class="fa fa-home"></i> Tất cả
                </a>
            </li>
            @if(isset($danhMucs))
                @foreach($danhMucs as $dm)
                    <li class="nav-item">
                        <a class="nav-link {{ request('danh_muc') == $dm->id ? 'active' : '' }}"
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
<div class="container">
    {{ $slot }}
</div>

<footer>
    &copy; {{ date('Y') }} LaptopStore — Hệ thống cửa hàng Laptop uy tín hàng đầu
</footer>

{{-- Scripts --}}
<script src="/library/jquery-3.7.1.js"></script>
<script src="/library/popper.min.js"></script>
<script src="/library/bootstrap.bundle.min.js"></script>

</body>
</html>
