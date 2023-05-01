<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPurchaseController;
use App\Http\Controllers\ProductSaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;

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

Route::post('login', [AuthApiController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [AuthApiController::class, 'profile']);
    Route::delete('logout', [AuthApiController::class, 'logout']);


    Route::group(['prefix' => 'products'], function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('expired', [ProductController::class, 'expired']);
        Route::post('', [ProductController::class, 'store']);
        Route::put('removebyId/{id}', [ProductController::class, 'removeById']);
        Route::put('expirationId', [ProductController::class, 'expirationId']);
        Route::put('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'delete']);
    });

    Route::group(['prefix' => 'reference'], function () {
        Route::get('countries', [ReferenceController::class, 'country']);
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('', [CategoryController::class, 'index']);
        Route::post('', [CategoryController::class, 'store']);
        Route::get('{id}', [CategoryController::class, 'getById']);
        Route::put('{id}', [CategoryController::class, 'update']);
        Route::delete('{id}', [CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('', [UserController::class, 'index']);
        Route::post('', [UserController::class, 'store']);
        Route::get('{id}', [UserController::class, 'getById']);
        Route::put('{id}', [UserController::class, 'update']);
        Route::delete('{id}', [UserController::class, 'delete']);
    });

    Route::group(['prefix' => 'sales'], function () {
        Route::get('', [SaleController::class, 'index']);
    });

    Route::group(['prefix' => 'product-sale'], function () {
        Route::post('', [ProductSaleController::class, 'sale']);
    });

    Route::group(['prefix' => 'statistics'], function () {
        Route::get('', [StatisticsController::class, 'by_interval']);
        Route::get('common-products', [StatisticsController::class, 'common_products']);
        Route::get('product/{id}', [StatisticsController::class, 'product_stats']);
        Route::get('byuser/{id?}', [StatisticsController::class, 'users_stats']);
        Route::get('bycategory/{id?}', [StatisticsController::class, 'bycat']);
        Route::get('extended/products/{id?}' ,[StatisticsController::class, 'extended_prod']);
        Route::get('extended/users/{id?}', [StatisticsController::class, 'extended_user']);
        Route::get('extended/categories/{id?}', [StatisticsController::class, 'extended_categories']);
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('' , [DashboardController::class, 'dashboard']);
        Route::get('timegraph', [DashboardController::class, 'dash_time']);
        Route::get('today_sell', [DashboardController::class, 'today_sell']);
    });

    Route::group(['prefix' => 'purchase'], function () {
        Route::get('', [PurchaseController::class, 'index']);
    });

    Route::group(['prefix' => 'product-purchase'], function () {
        Route::post('', [ProductPurchaseController::class, 'purchase']);
    });

});
