{{-- 게시글 생성 폼 페이지 --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>새 게시글 작성</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">내용</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">게시글 작성</button>
    </form>
</div>
@endsection
