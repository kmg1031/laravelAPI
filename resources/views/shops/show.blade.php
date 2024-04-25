@extends('layouts.app')
@section('title', '상점 정보')

@section('content')

    <h1>상점 정보</h1>

    <div>
        <label for="name">상점 이름</label>
        <input type="text" id="name" name="name" value="{{ $shops->name }}" readonly>
    </div>
    {{-- 영업 시간 --}}
    <div>
        <input type="checkbox" id="is_all_day" name="is_all_day" value="1" {{ $shops->is_all_day ? 'checked' : '' }} disabled>
        <label for="is_all_day">24시간 운영</label>
    </div>
    <div>
        <label for="opened_at">오픈</label>
        <input type="time" id="opened_at" name="opened_at" value="{{ $shops->opened_at }}" {{ $shops->is_all_day ? 'disabled' : '' }} readonly>
    </div>
    <div>
        <label for="closed_at">마감</label>
        <input type="time" id="closed_at" name="closed_at" value="{{ $shops->closed_at }}" {{ $shops->is_all_day ? 'disabled' : '' }} readonly>
    </div>
    {{-- /영업 시간 --}}
    <div>
        <label for="address">상점 주소</label>
        <input type="text" id="address" name="address" value="{{ $shops->address }}" readonly>
    </div>
    <div>
        @auth
            <!-- 수정 버튼 -->
            <button id="btn-edit">수정</button>
            <!-- 삭제 버튼 -->
            <button id="btn-delete">삭제</button>
        @endif
        <!-- 취소 버튼 -->
        <button id="btn-goBack">취소</button>
    </div>

    @auth
        <form id="form-delete" method="POST" action="{{ route('shops.destroy', $shops->idx) }}">
            @csrf
            @method('DELETE')
        </form>
    @endauth

    <script>
        // 수정 버튼 클릭 이벤트
        document.getElementById('btn-edit').addEventListener('click', function() {
            location.href = '{{ route('shops.edit', $shops->idx) }}';
        });

        // 삭제 버튼 클릭 이벤트
        document.getElementById('btn-delete').addEventListener('click', function() {
            if(confirm('정말 삭제하시겠습니까?')) {
                document.getElementById('form-delete').submit();
            }
        });

        // 취소 버튼 클릭 이벤트
        document.getElementById('btn-goBack').addEventListener('click', function() {
            location.href = '{{ route('shops.index') }}';
        });

    </script>
@endsection
