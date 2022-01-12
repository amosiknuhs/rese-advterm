<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function getReserves()
    {
        return Reserve::with(['shop'])->where('user_id', Auth::id())->get();
    }
    public function getFavorites()
    {
        return Favorite::with(['shop.area', 'shop.genre'])->where('user_id', Auth::id())->get();
    }
}
