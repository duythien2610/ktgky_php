<x-laptop-layout>
    <x-slot name="title">Trang chủ</x-slot>

    {{-- ===== SORT BAR ===== --}}
    <div class="sort-bar mt-3">
        <div class="d-flex align-items-center flex-wrap gap-2">
            <span class="title-bar me-3">
                @if(isset($danhMucHienTai) && $danhMucHienTai)
                    <i class="fa fa-tag"></i> {{ $danhMucHienTai->ten_danh_muc }}
                    <small class="text-muted ms-2">({{ $sanPhams->count() }} sản phẩm)</small>
                @else
                    <i class="fa fa-fire" style="color:#e94560"></i> Nổi bật
                    <small class="text-muted ms-2">({{ $sanPhams->count() }} sản phẩm)</small>
                @endif
            </span>

            {{-- Nút sort giá --}}
            <a href="{{ url('/') }}?{{ http_build_query(array_merge(request()->query(), ['sort' => 'asc'])) }}"
               class="btn-sort {{ isset($sort) && $sort === 'asc' ? 'active' : '' }}">
                <i class="fa fa-sort-amount-asc"></i> Giá tăng dần
            </a>
            <a href="{{ url('/') }}?{{ http_build_query(array_merge(request()->query(), ['sort' => 'desc'])) }}"
               class="btn-sort {{ isset($sort) && $sort === 'desc' ? 'active' : '' }}">
                <i class="fa fa-sort-amount-desc"></i> Giá giảm dần
            </a>
            @if(isset($sort) && $sort)
                <a href="{{ url('/') }}?{{ http_build_query(array_filter(['danh_muc' => request('danh_muc')])) }}"
                   class="btn-sort" style="border-color:#999; color:#999;">
                    <i class="fa fa-times"></i> Bỏ sắp xếp
                </a>
            @endif
        </div>
    </div>

    {{-- ===== DANH SÁCH SẢN PHẨM ===== --}}
    @if($sanPhams->isEmpty())
        <div class="empty-state">
            <i class="fa fa-search"></i>
            <h5>Không tìm thấy sản phẩm nào</h5>
            <p>Vui lòng thử lại với tiêu chí khác.</p>
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