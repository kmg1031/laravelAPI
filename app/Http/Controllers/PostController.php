<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    // 게시글 목록을 보여주는 메서드
    public function index()
    {
        Log::info('게시글 목록을 조회합니다.');

        $posts = Post::all(); // 모든 게시글을 조회
        return view('posts.index', compact('posts'));
    }

    // 게시글 생성 폼을 보여주는 메서드
    public function create()
    {
        Log::info('게시글 생성 폼을 보여줍니다.');

        return view('posts.create');
    }

    // 새 게시글을 저장하는 메서드
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'user_idx' => auth()->user()->idx,
            'user_name' => auth()->user()->name ?? '나',
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')
                         ->with('success', '게시글이 성공적으로 작성되었습니다.');
    }

    // 개별 게시글을 보여주는 메서드
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 게시글 수정 폼을 보여주는 메서드
    public function edit(Post $post)
    {
        // 본인만 수정할 수 있도록 수정
        if ($post->user_idx !== auth()->user()->idx) {
            return redirect()->route('posts.index')->with('error', '수정 권한이 없습니다.');
        }

        return view('posts.edit', compact('post'));
    }

    // 기존 게시글을 업데이트하는 메서드
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        // 게시글 페이지로 이동
        return redirect()->route('posts.show', $post)->with('success', '게시글이 성공적으로 수정되었습니다.');
    }

    // 게시글을 삭제하는 메서드
    public function destroy(Post $post)
    {
        if ($post->user_idx !== auth()->user()->idx) {
            return redirect()->route('posts.index')->with('error', '수정 권한이 없습니다.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', '게시글이 삭제되었습니다.');
    }
}
