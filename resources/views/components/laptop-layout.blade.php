@props(['title' => 'Laptop Store', 'categories' => []])
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'LaptopStore' }}</title>

    <link rel="stylesheet" href="{{ asset('library/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
            background: #fff;
        }

        .container-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background-color: #1a2732;
            padding: 12px 0;
        }

        .brand-list {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .brand-list a {
            color: #fff;
            font-weight: 700;
            font-size: 1.05rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        .brand-list a:hover {
            color: #28a745;
        }

        .search-container {
            flex: 1;
            max-width: 320px;
            margin: 0 20px;
            position: relative;
        }
        .search-container input {
            width: 100%;
            padding: 8px 40px 8px 15px;
            border: none;
            border-radius: 20px;
            background-color: white;
            font-size: 0.9rem;
            outline: none;
        }
        .search-container button {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            padding: 0;
            font-size: 1rem;
        }

        .cart-icon-wrap {
            position: relative;
            margin-right: 25px;
            font-size: 1.6rem;
        }
        .cart-icon-wrap a {
            color: #fff;
            text-decoration: none;
        }
        .cart-badge {
            position: absolute;
            top: -6px;
            right: -12px;
            background-color: #28a745;
            color: white;
            font-size: 11px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .user-auth-btn {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px 15px;
            font-size: 0.95rem;
            font-weight: 600;
        }
        .user-auth-btn:hover {
            background-color: #218838;
            color: white;
        }

        /* ===== LAPTOP GRID ===== */
        .list-laptop {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .laptop {
            text-align: center;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            overflow: hidden;
            cursor: pointer;
            background: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            text-decoration: none !important;
        }
        .laptop:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .laptop img {
            width: 100%;
            height: 180px;
            object-fit: contain;
            padding: 10px;
        }

        .laptop-info {
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }
        .laptop-info .laptop-title {
            font-size: 0.85rem;
            color: #000;
            font-weight: 600;
            line-height: 1.4;
            height: 2.8em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 8px;
            text-align: center;
        }
        .laptop-info .laptop-price {
            color: #d70018;
            font-weight: 700;
            font-size: 1rem;
            text-align: center;
            font-style: italic;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #888;
        }

        footer {
            background: #1a2732;
            color: #aaa;
            text-align: center;
            padding: 16px;
            margin-top: 40px;
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .list-laptop { grid-template-columns: repeat(3, 1fr); }
            .brand-list { flex-wrap: wrap; }
        }
        @media (max-width: 768px) {
            .list-laptop { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) {
            .list-laptop { grid-template-columns: repeat(1, 1fr); }
        }
    </style>
</head>
<body>

{{-- ===== BANNER ===== --}}
<div style="background:#1a2732;">
    <div style="text-align:center; margin:0 auto;">
        <img src="{{ asset('images/banner.png') }}" style="width:100%; object-fit:cover; display:block;">
    </div>
</div>

{{-- ===== NAVBAR ===== --}}
<div class="navbar-custom">
    <div class="container-main" style="display:flex; align-items:center; justify-content:space-between; flex-wrap: wrap; gap:10px;">

        {{-- Brands Menu --}}
        <div class="brand-list">
            @if(isset($categories))
                @foreach($categories as $dm)
                    <a href="{{ url('/') }}?danh_muc={{ $dm->id }}"
                       @if(request('danh_muc') == $dm->id) style="color:#28a745;" @endif>
                        {{ $dm->ten_danh_muc }}
                    </a>
                @endforeach
            @endif
        </div>

        <div style="display: flex; align-items: center;">
            {{-- Tìm kiếm --}}
            <div class="search-container">
                <form method="GET" action="{{ url('/tim-kiem') }}">
                    <input type="text" name="q" placeholder="Tìm kiếm laptop..." value="{{ request('q') }}">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            {{-- Giỏ hàng --}}
            <div class="cart-icon-wrap">
                @php $soLuongGio = collect(session('cart', []))->sum('so_luong'); @endphp
                <a href="{{ url('/gio-hang') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="cart-badge">{{ $soLuongGio }}</span>
                </a>
            </div>

            {{-- Auth --}}
            <div style="display:flex; align-items:center; gap:6px;">
                @auth
                    <div class="dropdown">
                        <button type="button" class="btn user-auth-btn dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.index') }}">
                                <i class="fa fa-cog mr-2"></i> Quản lý
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa fa-sign-out mr-2"></i> Đăng xuất
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn user-auth-btn mr-1">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn user-auth-btn" style="background:#0f3460;">Đăng ký</a>
                @endauth
            </div>
        </div>

    </div>
</div>

{{-- ===== NỘI DUNG CHÍNH ===== --}}
<main class="container-main" style="padding-top: 15px;">
    {{ $slot }}
</main>

<footer>
    &copy; {{ date('Y') }} LaptopStore — Khách hàng là thượng đế
</footer>

{{-- Scripts --}}
<script src="{{ asset('library/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('library/popper.min.js') }}"></script>
<script src="{{ asset('library/bootstrap.bundle.min.js') }}"></script>

</body>
</html>