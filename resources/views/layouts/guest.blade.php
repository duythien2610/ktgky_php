<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LaptopStore') }}</title>

    <link rel="stylesheet" href="/library/bootstrap.min.css">
    <link rel="stylesheet" href="/library/font-awesome.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .auth-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 24px;
        }
        .auth-logo a {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            letter-spacing: 1px;
        }
        .auth-logo a span { color: #e94560; }
        .auth-logo .subtitle {
            color: #aaa;
            font-size: 0.88rem;
            margin-top: 4px;
        }
        .auth-card {
            background: #fff;
            border-radius: 16px;
            padding: 32px 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }
        .auth-card label {
            font-weight: 500;
            color: #444;
            font-size: 0.88rem;
            margin-bottom: 4px;
        }
        .auth-card .form-control {
            border-radius: 8px;
            border: 1.5px solid #e0e0e0;
            padding: 10px 14px;
            font-size: 0.92rem;
            transition: border-color 0.2s;
        }
        .auth-card .form-control:focus {
            border-color: #0f3460;
            box-shadow: 0 0 0 3px rgba(15,52,96,0.1);
        }
        .btn-auth {
            background: linear-gradient(135deg, #0f3460, #e94560);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 11px;
            font-size: 0.95rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: opacity 0.2s;
            letter-spacing: 0.5px;
        }
        .btn-auth:hover { opacity: 0.88; }
        .invalid-feedback { font-size: 0.8rem; }
        .auth-link { color: #0f3460; text-decoration: none; font-size: 0.88rem; }
        .auth-link:hover { color: #e94560; }
        .divider { text-align: center; color: #aaa; font-size: 0.85rem; margin: 16px 0; }
    </style>
</head>
<body>
<div class="auth-wrapper">
    {{-- Logo --}}
    <div class="auth-logo">
        <a href="/"><i class="fa fa-laptop"></i> Laptop<span>Store</span></a>
        <div class="subtitle">Hệ thống cửa hàng Laptop uy tín</div>
    </div>

    {{-- Nội dung form --}}
    <div class="auth-card">
        {{ $slot }}
    </div>
</div>

<script src="/library/jquery-3.7.1.js"></script>
<script src="/library/bootstrap.bundle.min.js"></script>
</body>
</html>
