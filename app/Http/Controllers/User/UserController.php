<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 유저 등록 양식을 표시하는 메소드
    public function create()
    {
        return view('users.create');
    }

    // 유저 등록 양식 제출을 처리하는 메소드
    public function store(Request $request)
    {

        // log
        \Log::info('user store method');
        \Log::info($request);

        // 'id' => 'testuser',
        // 'password' => 'password123',
        // 'name' => 'TestUser',
        // 'email' => 'test@example.com',
        // 'phone' => '1234567890',
        $request->validate([
            'id' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:255',
        ]);

        \Log::info('user store method after validation');

        User::create([
            'id' => $request->id,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        \Log::info('user store method after create');

        return redirect()->route('register')->with('success', 'User successfully registered.');
    }
}
