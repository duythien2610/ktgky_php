<x-laptop-layout>
    <x-slot name="title">Tìm kiếm: {{ $tuKhoa }}</x-slot>

    {{-- Sort bar --}}
    <div class="sort-bar mt-3">
        <div class="d-flex align-items-center">
            <span class="title-bar">
                <i class="fa fa-search" style="color:#0f3460"></i>
                Kết quả tìm kiếm cho: "<strong>{{ $tuKhoa }}</strong>"
                <small class="text-muted ms-2">({{ $sanPhams->count() }} kết quả)</small>
            </span>
        </div>
    </div>

    {{-- Danh sách kết quả --}}
    @if($tuKhoa === '')
        <div class="empty-state">
            <i class="fa fa-keyboard-o"></i>
            <h5>Vui lòng nhập từ khóa để tìm kiếm</h5>
        </div>
    @elseif($sanPhams->isEmpty())
        <div class="empty-state">
            <i class="fa fa-frown-o"></i>
            <h5>Không tìm thấy laptop nào khớp với "{{ $tuKhoa }}"</h5>
            <p>Hãy thử từ khóa khác như: Dell, Asus, Core i7...</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-2">Về trang chủ</a>
        </div>
    @else
        <div class="list-laptop">
            @foreach($sanPhams as $sp)
                <a href="{{ url('/san-pham/' . $sp->id) }}" class="laptop">
                    <img src="{{ asset('storage/image/' . $sp->hinh_anh) }}"
                         alt="{{ $sp->tieu_de }}"
                         onerror="this.style.display='none'">
                    <div class="laptop-info">
                        <div class="laptop-title">{{ $sp->tieu_de }}</div>
                        <div class="laptop-price">
                            {{ number_format($sp->gia, 0, ',', '.') }}₫
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</x-laptop-layout>
