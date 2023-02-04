<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ServiceController;
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

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    //Auth
    Route::post('register', [AuthController::class, 'register']);
    Route::get('logout', [AuthController::class, 'logout']);

    //Products
    Route::get('get_products', [ProductController::class, 'index']);
    Route::post('add_product', [ProductController::class, 'store']);
    Route::post('update_product/{id}', [ProductController::class, 'update']);
    Route::delete('delete_product/{id}', [ProductController::class, 'destroy']);

    //Services
    Route::get('get_services', [ServiceController::class, 'index']);
    Route::post('add_service', [ServiceController::class, 'store']);
    Route::post('update_service/{id}', [ServiceController::class, 'update']);
    Route::delete('delete_service/{id}', [ServiceController::class, 'destroy']);

    //Sells
    Route::post('add_sell', [SellController::class, 'store']);
    Route::get('get_sales', [SellController::class, 'index']);
    
});
