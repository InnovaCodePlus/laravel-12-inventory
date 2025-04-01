<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;



Route::get('/categories', [CategoryController::class, 'index']);