<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\FrontendPostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/{slug}', [HomeController::class, 'agreements']);

#Post
Route::get('post/detail/{slug}', [FrontendPostController::class, 'show']);
#Post

#Category
Route::get('/category/{slug}', [HomeController::class, 'singleCategorie']);
#Category




