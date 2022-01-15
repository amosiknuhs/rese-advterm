<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReserveRequest;

class ReserveController extends Controller
{
    public function reserve(ReserveRequest $request)
    {
        $rsvContent = $request->all();
        $rsvContent['user_id'] = Auth::id();
        Reserve::create($rsvContent);
        // if (Auth::id() != null) {
        // } else {
        //     return response()->json(['isLogin' => false]);
        // }
    }

    public function cancel(Request $request)
    {
        Reserve::find($request->reserveId)->delete();
    }
}
