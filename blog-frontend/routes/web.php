<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\FrontendPostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/', [HomeController::class, 'index']);

#Post
Route::get('post/detail/{slug}', [FrontendPostController::class, 'show']);
#Post

#Category
Route::get('/category/{slug}', [HomeController::class, 'SingleCategory']);
#Category


Route::get('/kvkk-aydinlatma-metni', [HomeController::class,'kvkk']);
Route::get('/gizlilik-politikasi', [HomeController::class,'privacy_policy']);



Route::get('/comment-post', [HomeController::class,'commentGet']); //kendimce sayfayı korumak amaçlı yaptım.
Route::post('/comment-post', [HomeController::class, 'commentPost'])->name('commentPost');

