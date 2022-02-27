<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Reserve;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function owner()
    {
        return Owner::with(['shop.reservations.user', 'shop.area', 'shop.genre'])->where('id', Auth::id())->first();
    }

    public function getReserveList(Request $request)
    {
        return Reserve::with(['user'])->where('shop_id', $request->shop_id)->orderby('id', 'asc')->get();
    }


    public function ownerShopUpdate(Request $request)
    {
        $shopContent = $request->all();
        Shop::find($request->id)->update($shopContent);
    }

    public function shopImageUpload(ImageRequest $request)
    {
        $file_name = $request->file->getClientOriginalName();
        $request->file->storeAs('public/', $file_name);
        Shop::find($request->shop_id)->update(['img_url' => '/storage/' . $file_name]);
    }
}
