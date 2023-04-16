<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPurchaseController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferenceController;
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

    Route::group(['prefix' => 'users'], function (){
        Route::get('', [UserController::class, 'index']);
        Route::post('', [UserController::class, 'store']);
        Route::get('{id}', [UserController::class, 'getById']);
        Route::put('{id}', [UserController::class, 'update']);
        Route::delete('{id}', [UserController::class, 'delete']);
    });

    Route::group(['prefix'=>'purchases'], function() {
        Route::get('', [PurchaseController::class, 'index']);
    });

    Route::group(['prefix'=>'product-purchase'], function() {
        Route::post('', [ProductPurchaseController::class, 'purchase']);
    });

});
