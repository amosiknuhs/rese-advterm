<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user;
        $user['password'] = Hash::make($user['password']);
        User::create($user);
    }
}
