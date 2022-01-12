<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Collection;
use App\Models\Shop;

class ShopController extends Controller
{
    public function home()
    {
        return Shop::with(['area', 'genre', 'favorites'])->get();

        // 下の方法だとなぜだめなんだろう
        // $shops =  Shop::all();
        // return response()->json(['shops' => $shops]);
    }

    public function detail(Shop $shop)
    {
        $shop_id = $shop->id;
        $shopDetail = Shop::with(['area', 'genre', 'favorites'])->where('id', $shop_id)->get();
        return $shopDetail[0];
        // return $shop->with(['area', 'genre'])->get();　これだと全てのショップのデータを持ってきてしまっている
        // withは一覧全部持ってくる？
    }
}
