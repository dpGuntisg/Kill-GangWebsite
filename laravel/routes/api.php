<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\api\YoutubeLinkController;

// Open Routes
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// Product routes 
Route::get('products', [ProductController::class, 'index']);
 // Awards routes
Route::get('awards', [AwardController::class, 'index']);

 // Member routes
Route::get('members', [MemberController::class, 'index']);
 // Youtube/Home page routes
Route::get('/youtube-link', [YoutubeLinkController::class, 'getYoutubeLink']);
    

// Protected Routes for Admin
Route::group(['middleware' => ['auth:api', 'CheckRole:admin']], function () {
    // Image upload
    Route::post('/upload', [ImageController::class, 'upload']);
    
    // Awards routes
    Route::put('/awards/{id}', [AwardController::class, 'update']);
    Route::delete('/awards/{id}', [AwardController::class, 'destroy']);
    Route::post('/awards', [AwardController::class, 'store']); 

    // Member routes
    Route::post('/members', [MemberController::class, 'store']);
    Route::put('/members/{id}', [MemberController::class, 'update']);
    Route::delete('/members/{id}', [MemberController::class, 'destroy']);

    // Product routes
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    // Youtube/Home page routes

    Route::put('/youtube-link', [YoutubeLinkController::class, 'updateYoutubeLink'])->middleware('auth:api');
});

// Protected Routes for Authenticated Users
Route::group(['middleware' => ['auth:api']], function () {
    // User routes
    Route::delete('delete', [UserController::class, 'delete']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::put('profile', [UserController::class, 'update']);
    Route::post('logout', [UserController::class, 'logout']);


    
    // Cart routes
    Route::post('cart', [CartController::class, 'addToCart']);
    Route::get('cart', [CartController::class, 'getCartItems']);
    Route::delete('cart/{id}', [CartController::class, 'removeFromCart']);
    Route::get('cart/total', [CartController::class, 'getTotal']);


});