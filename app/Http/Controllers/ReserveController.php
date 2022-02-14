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
    }

    public function change(ReserveRequest $request)
    {
        $rsvContent = $request->all();
        Reserve::find($request->id)->update($rsvContent);
    }

    public function cancel(Request $request)
    {
        Reserve::find($request->reserveId)->delete();
    }

    public function checkout(Request $request)
    {
        $lineItems = [
            [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => '宴会コース'
                    ],
                    'unit_amount' => $request->amount,
                ],
                'description' => '飲食店予約アプリReseにてご予約いただいているコースの事前決済（店名：' . $request->shop_name . '、人数：' . $request->number . '名、1名：3,000円）',
                'quantity' => 1
            ]
        ];

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        return compact('session');
    }
}
