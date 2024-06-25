@extends('layouts.app')
@section('title', '메뉴 추가')

@section('content')

    <h1>메뉴 추가</h1>

    <form method="POST" action="{{ route('shops.menus.store', ['shop' => $shop->idx]) }}">
        @csrf
        <div>
            <label for="menu_name">메뉴 이름</label>
            <input type="text" id="menu_name" name="menu_name" value="{{ old('menu_name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="menu_price">가격</label>
            <input type="number" id="menu_price" name="menu_price" value="{{ old('menu_price') }}">
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        {{-- <div>
            <label for="image">이미지</label>
            <input type="text" id="image" name="image" value="{{ old('image') }}">
            @error('image')
                <div>{{ $message }}</div>
            @enderror
        </div> --}}
        <div>
            <label for="menu_description">설명</label>
            <textarea id="menu_description" name="menu_description">{{ old('menu_description') }}</textarea>
            @error('description')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button id="btn-add">추가</button>
        @production
        @else
            <button type="button" onclick="populateTestData()">테스트 데이터 생성</button>
            <script>
                function populateTestData() {
                    document.querySelector('#menu_name').value = '메뉴 이름';
                    document.querySelector('#menu_price').value = 10000;
                    // document.querySelector('#image').value = 'https://via.placeholder.com/150';
                    document.querySelector('#menu_description').value = '메뉴 설명';
                }
            </script>
        @endproduction

    <script>

        // 취소 버튼 클릭 이벤트
        document.getElementById('btn-cancel').addEventListener('click', function(e) {
            e.preventDefault();
            location.href = '{{ route('shops.index') }}';
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            if (!confirm('추가하시겠습니까?')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
