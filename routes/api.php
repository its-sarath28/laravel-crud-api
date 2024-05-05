<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/auth/sign-up', [App\Http\Controllers\AuthController::class, "signUp"]);

Route::post('/v1/auth/sign-in', [App\Http\Controllers\AuthController::class, "signIn"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/products', [App\Http\Controllers\ProductController::class, 'getAllProducts']);

    Route::post('/v1/products/create-product', [App\Http\Controllers\ProductController::class, 'createProduct']);

    Route::get('/v1/products/{productId}', [App\Http\Controllers\ProductController::class, 'getSingleProduct']);

    Route::put('/v1/products/{productId}/update-product', [App\Http\Controllers\ProductController::class, 'updateProduct']);

    Route::delete('/v1/products/{productId}/delete-product', [App\Http\Controllers\ProductController::class, 'deleteProduct']);
});
