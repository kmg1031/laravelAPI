@extends('layouts.app')
@section('title', '메뉴 수정')

@section('content')

    <h1>메뉴 수정</h1>

    <form method="POST" action="{{ route('shops.menus.update', ['shop' => $shop->idx, 'menu' => $menu->menu_idx]) }}">
        @csrf
        @method('PATCH')
        <div>
            <label for="menu_name">메뉴 이름</label>
            <input type="text" id="menu_name" name="menu_name" value="{{ old('menu_name', $menus->menu_name) }}">
            @error('menu_name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="menu_price">가격</label>
            <input type="number" id="menu_price" name="menu_price" value="{{ old('menu_price', $menus->menu_price) }}">
            @error('menu_price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="menu_escription">설명</label>
            <textarea id="menu_description" name="menu_description">{{ old('menu_description', $menus->menu_description) }}</textarea>
            @error('menu_description')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button>수정</button>
        <button id="btn-cancel">취소</button>

    <script>
        // 취소 버튼 클릭 이벤트
        document.getElementById('btn-cancel').addEventListener('click', function(e) {
            e.preventDefault();
            location.href = '{{ route('shops.show', $shops->idx) }}';
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            if (!confirm('수정하시겠습니까?')) {
                e.preventDefault();
            }
        });

</script>
@endsection
