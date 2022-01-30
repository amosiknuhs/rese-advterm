<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($request->is('api/user/*')) {
            $guard = 'user';
        } elseif ($request->is('api/owner/*')) {
            $guard = 'owner';
        } elseif ($request->is('api/admin/*')) {
            $guard = 'admin';
        }

        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => 'ログインに成功しました'], 200);
        }

        throw ValidationException::withMessages([
            'login_error' => '※メールかパスワードが間違っています',
        ]);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        Auth::guard('owner')->logout();
        Auth::guard('admin')->logout();
        return response()->json(['message' => 'ログアウトしました'], 200);
    }
}
