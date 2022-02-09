<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('app');
// })->name('/');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

// Route::get('/', function () {
//     return view('app');
// })->name('top');

// // ユーザー登録時メール確認機能

// // 新規登録後のメール確認依頼画面（不要予定）
// Route::get('/email/verify', function () {
//     // return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// // 送られてきたメール確認リンクをクリックした後の挙動
// use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/');
// })->middleware(['auth', 'signed'])->name('verification.verify');
