<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});


// Route untuk menampilkan daftar produk
Route::resource('products', ProductController::class);
Route::resource('warehouses', WarehouseController::class);
Route::resource('vehicles', VehicleController::class);
Route::resource('transactions', TransactionController::class);

// // Route untuk form create dan edit produk
// Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
// Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');


// // Route untuk form create dan edit produk
// Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
// Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');