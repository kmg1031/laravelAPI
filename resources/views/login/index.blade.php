{{-- 게시글 목록 페이지 --}}
@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        {{-- 미구현 --}}
        {{-- <div>
            <div>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                    Remember Me
                </label>
            </div>
        </div> --}}

        <div>
            <button type="submit">Login</button>
        </div>

    </form>

    <a href="{{ route('users.create') }}">Join</a>

@endsection
