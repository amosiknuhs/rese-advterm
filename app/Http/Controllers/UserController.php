<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user(Request $request)
    {
        return $request->user();
    }

    public function create(RegisterRequest $request)
    {
        $user = $request->all();
        $user['password'] = Hash::make($user['password']);
        User::create($user);
    }
}
