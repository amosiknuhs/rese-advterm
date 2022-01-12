<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ログイン・ログアウト機能
Route::post('/login', [AuthController::class, "login"]);
Route::post('/logout', [AuthController::class, "logout"]);
// 飲食店検索機能
Route::get('/', [ShopController::class, "home"]);
Route::get('/detail/{shop}', [ShopController::class, "detail"]);
// ユーザー登録機能
Route::post('/register', [UserController::class, "create"]);
// 予約登録機能
Route::post('/reserve', [ReserveController::class, "reserve"]);
// 予約削除機能
Route::post('/cancel', [ReserveController::class, "cancel"]);
// お気に入り登録・解除機能
Route::post('/favorite', [FavoriteController::class, "favorite"]);
// マイページで予約情報を取得
Route::get('/mypage/reserves', [MypageController::class, "getReserves"]);
// マイページでお気に入り情報を取得
Route::get('/mypage/favorites', [MypageController::class, "getFavorites"]);
