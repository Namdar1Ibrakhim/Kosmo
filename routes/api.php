<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\SetController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\OrderController;





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register'])->middleware('auth:sanctum');

Route::post('sms-send', [AuthController::class, 'sms_send']);

Route::post('sms-auth', [AuthController::class, 'sms_auth']);



Route::name('products.')->group(function(){

    Route::get('/products', [ProductController::class, 'getProducts'])->middleware('auth:sanctum');
    Route::get('/products/{id}', [ProductController::class, 'getProductById'])->middleware('auth:sanctum');

});


Route::name('sets.')->group(function(){

    Route::get('/sets', [SetController::class, 'getSets'])->middleware('auth:sanctum');;
    Route::get('/sets/{id}', [SetController::class, 'getSetById'])->middleware('auth:sanctum');;
    Route::get('/sets/{id}/products', [SetController::class, 'getSetProductsById'])->middleware('auth:sanctum');;

});

Route::name('carts.')->group(function(){

    Route::get('/carts', [CartController::class, 'cart'])->middleware('auth:sanctum');
    Route::get('/carts/products', [CartController::class, 'mycart'])->middleware('auth:sanctum');
    Route::post('/carts/add', [CartController::class, 'addtocart'])->middleware('auth:sanctum');
    Route::get('/carts/remove', [CartController::class, 'deletecart'])->middleware('auth:sanctum');

});

Route::name('orders.')->group(function() {

    Route::get('orders', [OrderController::class, 'orders'])->middleware('auth:sanctum');
    Route::get('makeOrder', [OrderController::class, 'makeOrder'])->middleware('auth:sanctum');

});
