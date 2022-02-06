<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Owner;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function admin()
    {
        return Admin::where('id', Auth::id())->first();
    }
    public function getOwnerList()
    {
        return Owner::with('shop')->get();
    }
    public function getUserList()
    {
        return User::all();
    }
    public function getShopList()
    {
        return Shop::with('area', 'genre')->get();
    }

    public function ownerCreate(AdminRequest $request)
    {
        $owner = $request->all();
        $owner['password'] = Hash::make($owner['password']);
        Owner::create($owner);
    }
}
