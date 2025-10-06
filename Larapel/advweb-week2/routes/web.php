<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AnggotaController; //akses controller lain
use App\Http\Controllers\SoalLatihanController;

Route::get('/', function () {
    return view('welcome');
});

// week 2

Route::get('tujuh', [Controller::class, 'helloFn']);

Route::get('delapan/{id}/{name}/{unit}', [Controller::class, 'getDataTarget']);

// pdf

Route::get('Tujuh', [Controller::class,'functionhello']); //route controller
Route::get('Delapan/{id}/{nama}/{satuan}',[Controller::class,'terimadataget']);

Route::get('tampilform',[Controller::class,'Tampilformpost']);
Route::post('terimadata',[Controller::class,'Terimadatapost']);

Route::get('tampil',[AnggotaController::class,'tampil']);

// soal

Route::get('luas-dan-volume/{panjang}/{lebar}/{tinggi}', [SoalLatihanController::class,'perhitunganLuas']);
Route::get('array', [SoalLatihanController::class,'tampilkanArray']);
Route::get('karyawan', [SoalLatihanController::class,'tampilkanKaryawan']);
Route::get('barang', [SoalLatihanController::class,'tampilkanBarang']);
Route::get('supplier', [SoalLatihanController::class,'tampilkanSupplier']);
