<?php

namespace App\Http\Controllers;

// use App\Models\Owner;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;


class OwnerController extends Controller
{
    public function owner()
    {
        return Owner::with(['shop.reservations.user', 'shop.area', 'shop.genre'])->where('id', Auth::id())->first();
    }

    public function getUserReservations(Request $request)
    {
        // dd($request->shop_id);
        // return Reserve::with(['user'])->where('shop_id', 1)->get();
        // return Reserve::with(['user'])->where('shop_id', $request->shop_id)->get();
    }
}
