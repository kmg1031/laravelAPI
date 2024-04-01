<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    // 유저 등록 양식을 표시하는 메소드
    public function login()
    {
        return view('login.index');
    }

    // 유저 등록 양식 제출을 처리하는 메소드
    public function loginProcess(Request $request)
    {

        // log
        Log::info('user store method');
        Log::info($request);

        $request->validate([
            'id' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        Log::info('user store method after validation');

        $user = User::where('id', $request->id)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);
            return redirect()->route('index');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }

    // 유저 로그아웃 처리하는 메소드
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }

}
