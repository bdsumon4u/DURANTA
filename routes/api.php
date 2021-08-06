<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
    Route::post('/cart/{product}/add', [\App\Http\Controllers\Api\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/{product}/update', [\App\Http\Controllers\Api\CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/content', [\App\Http\Controllers\Api\CartController::class, 'content'])->name('cart.content');
    Route::post('/cart/{rowId}/remove', [\App\Http\Controllers\Api\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [\App\Http\Controllers\Api\CartController::class, 'clear'])->name('cart.clear');
});
