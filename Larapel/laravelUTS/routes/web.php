<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});



Route::resource('products', ProductController::class);
Route::resource('warehouses', WarehouseController::class);
Route::resource('vehicles', VehicleController::class);
Route::resource('transactions', TransactionController::class);