<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/rese/{any}', function () {
    return view('app');
})->where('any', '.*');

// メール認証機能実装に伴う設定
Route::get('/rese/verify-notice', function () {
    return redirect('/rese/verify-notice');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/rese/thanks-mail-verify');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Stripeでの支払い成功画面とキャンセル後の画面の遷移設定
Route::get('/rese/payment-success', function () {
    return redirect('/rese/payment-success');
})->name('success');

Route::get('/rese/payment-cancel', function () {
    return redirect('/rese/payment-cancel');
})->name('cancel');
