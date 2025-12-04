<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('index', [ProductsController::class,'index']);
Route::get('create', [ProductsController::class,'create']);
Route::post('store', [ProductsController::class,'store']);
Route::get('edit/{products}', [ProductsController::class, 'edit']);
Route::put('update/{products}', [ProductsController::class, 'update']);
Route::delete('destroy/{products}', [ProductsController::class,'destroy']);