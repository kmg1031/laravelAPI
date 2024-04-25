@extends('layouts.app')
@section('title', '상점 추가')

@section('content')

    <h1>상점 추가</h1>

    <form method="POST" action="{{ route('shops.store') }}">
        @csrf
        <div>
            <label for="name">상점 이름</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        {{-- 영업 시간 --}}
        {{-- 24시간 운영 --}}
        <div>
            <input type="checkbox" id="is_all_day" name="is_all_day" value="1" {{ old('is_all_day') ? 'checked' : '' }}>
            <label for="is_all_day">24시간 운영</label>
        </div>
        {{-- 영업 시간 --}}
        <div>
            <label for="opened_at">오픈</label>
            <input type="time" id="opened_at" name="opened_at" value="{{ old('opened_at') }}" {{ old('is_all_day') ? 'disabled' : '' }}>
            @error('opened_at')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="closed_at">마감</label>
            <input type="time" id="closed_at" name="closed_at" value="{{ old('closed_at') }}" {{ old('is_all_day') ? 'disabled' : '' }}>
            @error('closed_at')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="address">상점 주소</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}">
            @error('address')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button id="btn-add">추가</button>
        @production
        @else
            <button type="button" onclick="populateTestData()">테스트 데이터 생성</button>
            <script>
                function populateTestData() {
                    document.querySelector('#name').value = '상점 이름';
                    document.querySelector('#is_all_day').checked = true;
                    document.querySelector('#opened_at').value = '09:00';
                    document.querySelector('#closed_at').value = '18:00';
                    document.querySelector('#address').value = '상점 주소';
                    document.querySelector('#phone').value = '상점 전화번호';
                    document.querySelector('#description').value = '상점 설명';
                }
            </script>
        @endproduction
        <button id="btn-cancel">취소</button>
    </form>

    <script>

        // 취소 버튼 클릭 이벤트
        document.getElementById('btn-cancel').addEventListener('click', function(e) {
            e.preventDefault();
            location.href = '{{ route('shops.index') }}';
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

        document.querySelector('form').addEventListener('submit', function(e) {
            var name = document.querySelector('#name').value;
            var allDay = document.querySelector('#is_all_day').checked;
            var opened_at = document.querySelector('#opened_at').value;
            var closed_at = document.querySelector('#closed_at').value;
            var address = document.querySelector('#address').value;
            var phone = document.querySelector('#phone').value;
            var description = document.querySelector('#description').value;

            // allday가 체크되어 있으면 opened_at, closed_at는 00:00으로 설정
            if (allDay) {
                document.querySelector('#opened_at').value = '00:00';
                document.querySelector('#closed_at').value = '00:00';
            }

            // allDay가 체크되어 있지 않으면 opened_at, closed_at는 필수 입력값
            if (!allDay && (!opened_at || !closed_at)) {
                alert('영업 시간을 입력해주세요.');
                e.preventDefault();
                return;
            }

            if (!name || !address || !phone || !description) {
                alert('필수 입력값을 입력해주세요.');
                e.preventDefault();
                return;
            }
        });
    </script>
@endsection
