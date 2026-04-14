<x-laptop-layout>
    <x-slot name="title">Tìm kiếm: {{ $tuKhoa }} - LaptopStore</x-slot>

    {{-- ===== THANH KẾT QUẢ ===== --}}
    <div style="background:#fff; padding:15px 0; margin-bottom:15px; display:flex; justify-content:center; align-items:center; gap:12px; flex-wrap:wrap;">
        <span style="font-size:0.95rem; font-weight:500; color:#333;">
            @if($tuKhoa !== '')
                Kết quả cho "{{ $tuKhoa }}" ({{ $sanPhams->count() }} sản phẩm) - Tìm kiếm theo
            @else
                Tìm kiếm sản phẩm
            @endif
        </span>

        @if($tuKhoa !== '' && $sanPhams->count() > 0)
            <a href="{{ url('/tim-kiem') }}?q={{ $tuKhoa }}&sort=asc"
               style="background:#fff; border:1px solid #ccc; padding:6px 15px; border-radius:4px; color:#333; text-decoration:none; font-size:0.9rem; {{ request('sort') === 'asc' ? 'border-color:#28a745; color:#28a745;' : '' }}">
                Giá tăng dần
            </a>
            <a href="{{ url('/tim-kiem') }}?q={{ $tuKhoa }}&sort=desc"
               style="background:#fff; border:1px solid #ccc; padding:6px 15px; border-radius:4px; color:#333; text-decoration:none; font-size:0.9rem; {{ request('sort') === 'desc' ? 'border-color:#28a745; color:#28a745;' : '' }}">
                Giá giảm dần
            </a>
            @if(request('sort'))
                <a href="{{ url('/tim-kiem') }}?q={{ $tuKhoa }}"
                   style="font-size:0.85rem; color:#d70018; text-decoration:none; margin-left:5px;">
                    ✕ Bỏ lọc
                </a>
            @endif
        @endif
    </div>

    {{-- ===== KẾT QUẢ TÌM KIẾM ===== --}}
    @if($tuKhoa === '')
        <div class="empty-state">
            <i class="fa fa-keyboard-o"></i>
            <h5>Nhập từ khóa để tìm kiếm</h5>
            <p style="font-size:0.9rem;">Ví dụ: Dell, Asus, Core i7, RTX 4060...</p>
        </div>
    @elseif($sanPhams->isEmpty())
        <div class="empty-state">
            <i class="fa fa-frown-o"></i>
            <h5>Không tìm thấy laptop nào khớp với "{{ $tuKhoa }}"</h5>
            <p style="font-size:0.9rem;">Hãy thử từ khóa khác như: Dell, Asus, Core i7...</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3" style="background:#1a2732; border-color:#1a2732;">Về trang chủ</a>
        </div>
    @else
        <div class="list-laptop">
            @foreach($sanPhams as $sp)
                <a href="{{ url('/san-pham/' . $sp->id) }}" class="laptop">
                    <img src="{{ asset('storage/image/' . $sp->hinh_anh) }}"
                         alt="{{ $sp->tieu_de }}"
                         onerror="this.src='https://via.placeholder.com/200x150?text=No+Image';">
                    <div class="laptop-info">
                        <div class="laptop-title">{{ $sp->tieu_de }}</div>
                        <div class="laptop-price">
                            {{ number_format($sp->gia, 0, ',', '.') }} VNĐ
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</x-laptop-layout>
