@extends('layouts.app')
@section('title', '메뉴 정보')

@section('content')

    <h1>메뉴 정보</h1>

    <div>
        <label>메뉴 이름</label>
        <div>{{ $menu->menu_name }}</div>
    </div>
    <div>
        <label>가격</label>
        <div>{{ $menu->menu_price }}</div>
    </div>
    {{-- <div>
        <label>이미지</label>
        <div>
            <img src="{{ $menu->menu_image_url }}" alt="{{ $menu->menu_name }}" style="width: 150px;">
        </div>
    </div> --}}
    <div>
        <label>설명</label>
        <div>{{ $menu->menu_description }}</div>
    </div>

    <a href="{{ route('shops.menus.edit', ['shop' => $shop->idx, 'menu' => $menu->menu_idx]) }}">수정</a>
    <button id="btn-delete">삭제</button>
    <button id="btn-cancel">취소</button>

    <form id="form-delete" method="POST" action="{{ route('shops.menus.destroy', ['shop' => $shop->idx, 'menu' => $menu->menu_idx]) }}">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.getElementById('btn-delete').addEventListener('click', function(e) {
            if (confirm('삭제하시겠습니까?')) {
                document.getElementById('form-delete').submit();
            }
        });

        document.getElementById('btn-cancel').addEventListener('click', function(e) {
            location.href = '{{ route('shops.menus.index', ['shop' => $shop->idx]) }}';
        });
    </script>

@endsection
