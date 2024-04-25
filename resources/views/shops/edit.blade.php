@extends('layouts.app')
@section('title', '상점 수정')

@section('content')

    <h1>상점 수정</h1>

    <form method="POST" action="{{ route('shops.update', $shops->idx) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">상점 이름</label>
            <input type="text" id="name" name="name" value="{{ old('name', $shops->name) }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        {{-- 영업 시간 --}}
        {{-- 24시간 운영 --}}
        <div>
            <input type="checkbox" id="is_all_day" name="is_all_day" value="1" {{ old('is_all_day', $shops->is_all_day) ? 'checked' : '' }}>
            <label for="is_all_day">24시간 운영</label>
        </div>
        {{-- 영업 시간 --}}
        <div>
            <label for="opened_at">오픈</label>
            <input type="time" id="opened_at" name="opened_at" value="{{ old('opened_at', $shops->opened_at) }}" {{ old('is_all_day', $shops->is_all_day) ? 'disabled' : '' }}>
            @error('opened_at')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="closed_at">마감</label>
            <input type="time" id="closed_at" name="closed_at" value="{{ old('closed_at', $shops->closed_at) }}" {{ old('is_all_day', $shops->is_all_day) ? 'disabled' : '' }}>
            @error('closed_at')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="address">상점 주소</label>
            <input type="text" id="address" name="address" value="{{ old('address', $shops->address) }}">
            @error('address')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button id="btn-edit">수정</button>
        <button id="btn-cancel">취소</button>
    </form>

    <script>
        // 취소 버튼 클릭 이벤트
        document.getElementById('btn-cancel').addEventListener('click', function(e) {
            e.preventDefault();
            location.href = '{{ route('shops.show', $shops->idx) }}';
        });

        document.querySelector('#is_all_day').addEventListener('change', function() {
            var opened_atTime = document.querySelector('#opened_at');
            var closed_atTime = document.querySelector('#closed_at');
            if (this.checked) {
                opened_atTime.disabled = true;
                closed_atTime.disabled = true;
            } else {
                opened_atTime.disabled = false;
                closed_atTime.disabled = false;
            }
        });

    </script>
@endsection
