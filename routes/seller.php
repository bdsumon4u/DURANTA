<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
|
| Here is where you can register seller routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('seller')->group(function ($router) {
    Route::redirect('/', $router->getLastGroupPrefix() . RouteServiceProvider::HOME);

    Route::group(['middleware' => ['auth:seller', 'verified'], 'as' => 'seller.'], function () {
        Route::get(RouteServiceProvider::HOME, \App\Http\Controllers\Seller\DashboardController::class)->name('dashboard');
    });
});
