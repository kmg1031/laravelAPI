<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    // 로그인 페이지
    public function login()
    {
        return view('login.index');
    }

    // 로그인 프로세스
    public function loginProcess(Request $request)
    {
        // log
        Log::info('user store method');
        Log::info($request);

        $rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ];


        if (Auth::attempt($request->only('email', 'password'))) {
            // login success
            Log::channel('login')->info('User login success.', ['email' => $request->email]);

            $user = Auth::user();
            session(['user' => $user]);

            return redirect()->route('index');
        }else{
            // login fail
            Log::channel('login')->warning('User login failed.', ['email' => $request->email]);

            return redirect()->route('login')->withErrors('Invalid email or password.');
        }
    }

    // 유저 로그아웃 처리하는 메소드
    public function logout(Request $request)
    {
        Auth::logout();

        // 세션을 무효화하고 재생성합니다.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

}
