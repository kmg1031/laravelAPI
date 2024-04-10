{{-- 개별 게시글 보기 페이지 --}}
@extends('layouts.app')

@section('content')
<div>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <div>
        <!-- 목록으로 돌아가기 버튼 -->
        @if(Auth::check() && Auth::user()->idx === $post->user_idx)
            <!-- 수정 버튼 -->
            <button id="btn-edit">수정</button>
            <!-- 삭제 버튼 -->
            <button id="btn-delete">삭제</button>
        @endif
        <button id="btn-goBack">목록으로 돌아가기</button>
    </div>
</div>

<!-- 삭제 폼 -->
<form id="form-delete" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
</form>

<script>

    // 돌아가기 버튼 클릭 이벤트
    document.getElementById('btn-goBack').addEventListener('click', function() {
        location.href = '{{ route('posts.index') }}';
    });

    // 수정 버튼 클릭 이벤트
    document.getElementById('btn-edit').addEventListener('click', function() {
        location.href = '{{ route('posts.edit', $post->id) }}';
    });

    // 삭제 버튼 클릭 이벤트
    document.getElementById('btn-delete').addEventListener('click', function() {
        if(confirm('정말 삭제하시겠습니까?')) {
            document.getElementById('form-delete').submit();
        }
    });
</script>
@endsection
