<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// home
Route::get('/', [HomeController::class, "index"]);
Route::get('/search', [HomeController::class, "search"]);
Route::get('/explore', [HomeController::class, "explore"]);

// auth
Auth::routes();

// profile
Route::get("/profile/{id}", [ProfileController::class, "show"]);
Route::get("/profile/{id}/edit", [ProfileController::class, "edit"]);
Route::put("/profile/{id}", [ProfileController::class, "update"]);

// post
Route::get("/post/create", [PostController::class, "create"]);
Route::post("/post", [PostController::class, "store"]);
Route::get("/post/{id}/edit", [PostController::class, "edit"]);
Route::put("/post/{id}", [PostController::class, "update"]);

// follow
Route::get("/follow/{id}", [FollowController::class, "store"]);
Route::delete("/follow/{id}", [FollowController::class, "destroy"]);

// like
Route::get("/like/{id}", [LikeController::class, "store"]);
Route::delete("/like/{id}", [LikeController::class, "destroy"]);

// generate storage