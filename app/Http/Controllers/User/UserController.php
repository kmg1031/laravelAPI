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
        try{
            // log
            \Log::info('user store method');
            \Log::info($request);

            // 'id' => 'testuser',
            // 'password' => 'password123',
            // 'name' => 'TestUser',
            // 'email' => 'test@example.com',
            // 'phone' => '1234567890',

            $request->validate([
                'id' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:4|confirmed',
                // 'phone' => 'required|string|max:255',
            ]);

            \Log::info('user store method after validation');

            User::create([
                'id' => $request->id,
                'password' => Hash::make($request->password),
                'name' => $request->name,
                'email' => $request->email ?? '',
                'phone' => $request->phone ?? '',
            ]);

            \Log::info('user store method after create');

            return response()->json(['result' => 'success', 'message' => 'User successfully registered.'], 200);
        }catch(\Exception $e){
            \Log::info('user store method after exception');
            return response()->json(['result' => 'error', 'message' => 'User registration failed.'], 500);
        }
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('users.mypage.show', $user)->with('success', 'User information successfully updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('index')->with('success', 'User successfully deleted.');
    }

}
