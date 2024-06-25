@extends('layouts.app')
@section('title', '상점 목록')

@section('content')

    <h1>상점 목록</h1>

    <a href="{{ route('shops.create') }}">상점 등록</a>

    <table>
        <thead>
            <tr>
                <th>상점 이름</th>
                <th>영업 시간</th>
                <th>수정</th>
                <th>삭제</th>
            </tr>
        </thead>
        <tbody>
            @if($shops->isEmpty())
                <tr>
                    <td colspan="4">상점이 없습니다.</td>
                </tr>
            @else
                @foreach ($shops as $shop)
                    <tr>
                        <td>
                            <a href="{{ route('shops.show', $shop->idx) }}">
                                {{ $shop->name }}
                            </a>
                        </td>
                        <td>
                            @if($shop->is_all_day)
                                24시간 운영
                            @else
                                {{ $shop->opened_at }} ~ {{ $shop->closed_at }}
                            @endif
                        </td>
                        {{-- 메뉴 관리 --}}
                        <td>
                            <a href="{{ route('shops.menus.index', ['shop' => $shop->idx]) }}">메뉴 관리</a>
                        </td>
                        <td>
                            @auth
                                <a href="{{ route('shops.edit', $shop->idx) }}">수정</a>
                            @endauth
                        </td>
                        <td>
                            @auth
                                <button class="btn-delete" onclick="deleteShop('{{ route('shops.destroy', $shop->idx) }}')">삭제</button>
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
