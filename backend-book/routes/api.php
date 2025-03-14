<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\store\BookController;
use App\Http\Controllers\store\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Public Routes
Route::post('/register' , [AuthController::class , 'register']);
Route::post('/login' , [AuthController::class , 'login']);


Route::apiResource('book' , BookController::class);
Route::apiResource('category' , CategoryController::class);
Route::get('/books/{lang}', [BookController::class, 'index']);

Route::get('categories/{lang}', [CategoryController::class, 'getCategoryTranslation']);

// Protected Routes (Requires Authentication)
Route::middleware('auth:sanctum', 'role:admin')->group(function () {
    Route::patch('/user/{id}/role', [AuthController::class, 'updateRole']); // Admin updates user role
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
