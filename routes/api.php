<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/json',[TestController::class, 'showCategories']);
Route::get('/json/view/{id?}',[SampleController::class, 'showCategory']);
Route::get('/products/create',[SampleController::class, 'createProduct']);
