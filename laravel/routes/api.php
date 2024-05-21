<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Syntax <URL>/api/register

// Open Routes
Route::post("register", [UserController::class, "register"]);
Route::post("login", [UserController::class, "login"]);

// Protected Routes
Route::group([
    "middleware" => ["auth:api"]
], function(){
    Route::delete("delete",[UserController::class, "delete"]);
    Route::get("profile", [UserController::class, "profile"]);
    Route::get("logout", [UserController::class, "logout"]);
    Route::post("logout", [UserController::class, "logout"]);
    Route::get('products', [ProductController::class, 'index']);
    Route::post('products', [ProductController::class, 'store']);
});
