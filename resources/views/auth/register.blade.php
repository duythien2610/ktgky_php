<x-guest-layout>
    <h5 class="mb-4 fw-bold text-center" style="color:#1a1a2e">
        <i class="fa fa-user-plus me-2" style="color:#e94560"></i>Tạo tài khoản mới
    </h5>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Họ tên --}}
        <div class="mb-3">
            <label for="name">Họ và tên</label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Nguyễn Văn A"
                   required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email">Địa chỉ Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="email@example.com"
                   required autocomplete="username">
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
                   placeholder="Tối thiểu 8 ký tự"
                   required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Xác nhận mật khẩu --}}
        <div class="mb-4">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="Nhập lại mật khẩu"
                   required autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút đăng ký --}}
        <button type="submit" class="btn-auth">
            <i class="fa fa-user-plus me-1"></i> Đăng ký tài khoản
        </button>

        <div class="divider">hoặc</div>

        <div class="text-center" style="font-size:0.88rem; color:#666">
            Đã có tài khoản?
            <a href="{{ route('login') }}" class="auth-link fw-600">Đăng nhập ngay</a>
        </div>
    </form>
</x-guest-layout>
