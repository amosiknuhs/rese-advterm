<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'ログインに成功しました'], 200);
        }

        throw ValidationException::withMessages([
            'login_error' => '※メールかパスワードが間違っています',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'ログアウトしました'], 200);
    }
}
