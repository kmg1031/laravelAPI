{{-- 게시글 수정 폼 페이지 --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>게시글 수정</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">내용</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
        </div>
        <button id="btn-eedit">게시글 수정</button>
        <button id="btn-cancel">취소</button>
    </form>
</div>
<script>
    // 취소 버튼 클릭 이벤트
    document.getElementById('btn-cancel').addEventListener('click', function() {
        location.href = '{{ route('posts.show', $post->id) }}';
    });
</script>
@endsection
