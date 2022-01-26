<?php

namespace App\Http\Controllers;

use App\Models\Shop;

class ShopController extends Controller
{
    public function home()
    {
        return Shop::with(['area', 'genre', 'favorites', 'evaluations'])->get();
    }

    public function detail(Shop $shop)
    {
        $shop_id = $shop->id;
        $shopDetail = Shop::with(['area', 'genre', 'favorites', 'evaluations'])->where('id', $shop_id)->get();
        return $shopDetail[0];
    }
}
