<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\OwnerController;

Route::middleware('auth:user,owner,admin')->group(function () {
    // ユーザー情報取得
    Route::get('/user', [UserController::class, "user"]);
    Route::get('/owner', [OwnerController::class, "owner"]);
    // マイページで予約情報を取得
    Route::get('/mypage/reserves', [MypageController::class, "getReserves"]);
    // マイページでお気に入り情報を取得
    Route::get('/mypage/favorites', [MypageController::class, "getFavorites"]);
    // 予約登録・変更機能
    Route::post('/reserve', [ReserveController::class, "reserve"]);
    Route::post('/change', [ReserveController::class, "change"]);
    // 予約削除機能
    Route::post('/cancel', [ReserveController::class, "cancel"]);
    // お気に入り登録・解除機能
    Route::post('/favorite', [FavoriteController::class, "favorite"]);
    // 評価登録機能
    Route::post('/evaluate', [EvaluationController::class, "evaluate"]);
});

// Route::middleware('auth:owner')->group(function () {
//     Route::get('/user', [UserController::class, "user"]);
//     Route::get('/mypage/reserves', [MypageController::class, "getReserves"]);
//     Route::get('/mypage/favorites', [MypageController::class, "getFavorites"]);
// });

// Route::middleware('auth:admin')->group(function () {
//     Route::get('/user', [UserController::class, "user"]);
//     Route::get('/mypage/reserves', [MypageController::class, "getReserves"]);
//     Route::get('/mypage/favorites', [MypageController::class, "getFavorites"]);
// });

// ユーザー登録機能
Route::post('/register', [UserController::class, "create"]);
// ログイン機能
Route::post('/user/login', [AuthController::class, "login"]);
Route::post('/owner/login', [AuthController::class, "login"]);
Route::post('/admin/login', [AuthController::class, "login"]);
// ログアウト機能
Route::post('/logout', [AuthController::class, "logout"]);
// 飲食店検索機能
Route::get('/', [ShopController::class, "home"]);
// 飲食店詳細取得
Route::get('/detail/{shop}', [ShopController::class, "detail"]);

Route::get('/owner/reservations', [OwnerController::class, "getUserReservations"]);
// Route::get('/owner/shop', [OwnerController::class, "getOwnerShopData"]);
