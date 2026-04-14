<x-guest-layout>
    {{-- Thông báo trạng thái session --}}
    @if(session('status'))
        <div class="alert alert-success mb-3" style="font-size:0.88rem; border-radius:8px;">
            {{ session('status') }}
        </div>
    @endif

    <h5 class="mb-4 fw-bold text-center" style="color:#1a1a2e">
        <i class="fa fa-sign-in me-2" style="color:#e94560"></i>Đăng nhập tài khoản
    </h5>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email">Địa chỉ Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="email@example.com"
                   required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Mật khẩu --}}
        <div class="mb-3">
            <label for="password">Mật khẩu</label>
            <input id="password"
                   type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Nhập mật khẩu"
                   required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ghi nhớ đăng nhập --}}
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label class="d-flex align-items-center gap-2 mb-0" style="cursor:pointer">
                <input type="checkbox" name="remember" id="remember_me">
                <span style="font-size:0.85rem; color:#666">Ghi nhớ đăng nhập</span>
            </label>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">Quên mật khẩu?</a>
            @endif
        </div>

        {{-- Nút đăng nhập --}}
        <button type="submit" class="btn-auth">
            <i class="fa fa-sign-in me-1"></i> Đăng nhập
        </button>

        <div class="divider">hoặc</div>

        <div class="text-center" style="font-size:0.88rem; color:#666">
            Chưa có tài khoản?
            <a href="{{ route('register') }}" class="auth-link fw-600">Đăng ký ngay</a>
        </div>
    </form>
</x-guest-layout>
