<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;  

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProductController::class, 'index']);

Route::post('/store/product',[ProductController::class, 'StoreProduct'])
    ->name('store.product');

Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

Route::middleware('auth:sanctum')->post('/help-email', [UserController::class, 'sendHelpEmail'])
    ->name('api.user.help_email');

