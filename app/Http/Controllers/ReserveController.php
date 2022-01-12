<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function reserve(Request $request)
    {
        $rsvContent = $request->reserve;
        $rsvContent['user_id'] = Auth::id();
        Reserve::create($rsvContent);
        // return response()->json('reserveMsg', '※予約を登録しました');
    }

    public function cancel(Request $request)
    {
        Reserve::find($request->reserveId)->delete();
        // return response()->json('cancelMsg', '※予約を削除しました');
    }
}
