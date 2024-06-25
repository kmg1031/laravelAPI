@extends('layouts.app')
@section('title', '메뉴 목록')

@section('content')

    <h1>메뉴 목록</h1>

    <a href="{{ route('shops.menus.create', ['shop' => $shop->idx]) }}">메뉴 추가</a>

    <table>
        <thead>
            <tr>
                <th>메뉴 이름</th>
                <th>가격</th>
                <th>이미지</th>
                <th>설명</th>
                <th>수정</th>
                <th>삭제</th>
            </tr>
        </thead>
        <tbody>
            @if($menus->isEmpty())
                <tr>
                    <td colspan="6">메뉴가 없습니다.</td>
                </tr>
            @else
                @foreach ($menus as $menu)
                    <tr>
                        <td>
                            <a href="{{ route('shops.menus.show', ['shop' => $shop->idx, 'menu' => $menu->menu_idx]) }}">
                                {{ $menu->menu_name }}
                            </a>
                        </td>
                        <td>{{ $menu->menu_price }}</td>
                        {{-- <td>
                            <img src="{{ $menu->menu_image_url }}" alt="{{ $menu->menu_name }}" style="width: 150px;">
                        </td> --}}
                        <td>{{ $menu->menu_description }}</td>
                        <td>
                            @auth
                                <a href="{{ route('shops.menus.edit', ['shop' => $shop->idx, 'menu' => $menu->menu_idx]) }}">수정</a>
                            @endauth
                        </td>
                        <td>
                            @auth
                                <button class="btn-delete" onclick="deleteMenu('{{ route('shops.menus.destroy', ['shop' => $shop->idx, 'menu' => $menu->menu_idx]) }}')">삭제</button>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            @endif
    </table>

    @auth
        <form id="form-delete" method="POST" action="">
            @csrf
            @method('DELETE')
        </form>
    @endauth

    <script>
        function deleteShop(url) {
            if(confirm('정말 삭제하시겠습니까?')) {
                document.getElementById('form-delete').action = url;
                document.getElementById('form-delete').submit();
            }
        }
    </script>

@endsection
