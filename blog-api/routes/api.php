<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\SiteSettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#POST
Route::get('/post', [PostController::class, 'index']);
Route::get('/popular-post', [PostController::class, 'populerPost']);
Route::get('/post/detail/{slug}',[PostController::class, "show"]);

#POST

#Category
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{slug}',[CategoryController::class, 'show']);


#Category


#COMMENTS
Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);
#COMMENTS

#Site Settings

Route::get('/kvkk-aydinlatma-metni', [SiteSettingsController::class, 'kvkk']);
Route::get('/privacy-policy', [SiteSettingsController::class, 'privacy_policy']);


#Site Settings
