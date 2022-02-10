<?php

use Illuminate\Support\Facades\Route;

Route::get('/rese/{any}', function () {
    return view('app');
})->where('any', '.*');

// メール認証機能実装に伴う設定
Route::get('/rese/verify-notice', function () {
    return redirect('/rese/verify-notice');
})->name('login');

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/rese/thanks-mail-verify');
})->middleware(['auth', 'signed'])->name('verification.verify');
