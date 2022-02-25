<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function getReserves()
    {
        return Reserve::with(['shop.evaluations', 'user'])->where('user_id', Auth::id())->orderBy('id', 'asc')->get();
    }
    public function getFavorites()
    {
        return Favorite::with(['shop.area', 'shop.genre', 'shop.evaluations'])->where('user_id', Auth::id())->orderBy('id', 'asc')->get();
    }
}
