<?php

use App\Http\Controllers\store\BookController;
use App\Http\Controllers\store\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('book' , BookController::class);
Route::apiResource('category' , CategoryController::class);
Route::get('/books/{lang}', [BookController::class, 'index']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
