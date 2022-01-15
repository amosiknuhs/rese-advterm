<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        $isFavorite = $request->isFavorite;
        $shopId = $request->shopId;
        $userId = Auth::id();
        if ($isFavorite == 0) {
            Favorite::create(['user_id' => $userId, 'shop_id' => $shopId]);
        } else if ($isFavorite == 1) {
            Favorite::where('user_id', $userId)
                ->where('shop_id', $shopId)
                ->delete();
        }
    }
}
