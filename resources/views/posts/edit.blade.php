{{-- 게시글 수정 폼 페이지 --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>게시글 수정</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>
        <div class="form-group">
            <label for="body">내용</label>
            <textarea class="form-control" id="body" name="body" rows="5" required>{{ $post->body }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">게시글 수정</button>
    </form>
</div>
@endsection
