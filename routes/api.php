<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/create_product', [ProductController::class,'create_product']);
Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
Route::post('/products/{product}', [ProductController::class, 'update']);

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);