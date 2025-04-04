<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Sale\SaleController;
use Orion\Facades\Orion;

// Route::get('/categories', [CategoryController::class, 'index']);

// Route::post('/categories', [CategoryController::class, 'store']);

// Route::get('/categories/{id}', [CategoryController::class, 'show']);

// Route::patch('/categories/{id}', [CategoryController::class, 'update']);

// Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

Route::apiResource('categories', CategoryController::class);

Orion::resource("products", ProductController::class);

Route::apiResource('sales', SaleController::class)
    ->only(["index", "show", "store"]);
