<x-laptop-layout>
    <x-slot name="title">Trang chủ - LaptopStore</x-slot>

    {{-- ===== THANH SẮP XẾP ===== --}}
    <div style="background:#fff; padding:15px 0; margin-bottom:15px; display:flex; justify-content:center; align-items:center; gap:12px;">
        <span style="font-size:0.95rem; font-weight:500; color:#333;">Tìm kiếm theo</span>
        <a href="{{ url('/') }}?{{ http_build_query(array_merge(request()->query(), ['sort' => 'asc'])) }}"
           style="background:#fff; border:1px solid #ccc; padding:6px 15px; border-radius:4px; color:#333; text-decoration:none; font-size:0.9rem; {{ isset($sort) && $sort === 'asc' ? 'border-color:#28a745; color:#28a745;' : '' }}">
            Giá tăng dần
        </a>
        <a href="{{ url('/') }}?{{ http_build_query(array_merge(request()->query(), ['sort' => 'desc'])) }}"
           style="background:#fff; border:1px solid #ccc; padding:6px 15px; border-radius:4px; color:#333; text-decoration:none; font-size:0.9rem; {{ isset($sort) && $sort === 'desc' ? 'border-color:#28a745; color:#28a745;' : '' }}">
            Giá giảm dần
        </a>
        @if(isset($sort) && $sort)
            <a href="{{ url('/') }}?{{ http_build_query(array_filter(['danh_muc' => request('danh_muc')])) }}"
               style="font-size:0.85rem; color:#d70018; text-decoration:none; margin-left:5px;">
                ✕ Bỏ lọc
            </a>
        @endif
    </div>

    {{-- ===== DANH SÁCH SẢN PHẨM ===== --}}
    @if($sanPhams->isEmpty())
        <div class="empty-state">
            <i class="fa fa-box-open"></i>
            <h5>Không tìm thấy sản phẩm nào</h5>
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