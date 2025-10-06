<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TugasController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('tujuh',[Controller::class, 'fungsihello']);
Route::get('/Delapan/{id}/{nama}/{satuan}',[Controller::class,'terimadataget']);

// 1. Hitung balok & kubus
Route::get('/hitung/{bangun}/{p}/{l?}/{t?}', [TugasController::class, 'hitungBangun']);

// 2. Data array
Route::get('/array', [TugasController::class, 'tampilArray']);

// 3. Data karyawan
Route::get('/karyawan', [TugasController::class, 'tampilKaryawan']);

// 4. Data barang
Route::get('/barang', [TugasController::class, 'tampilBarang']);

// 5. Data supplier
Route::get('/supplier', [TugasController::class, 'tampilSupplier']);