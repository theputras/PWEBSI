<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ControllerData;

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

Route::get('tampilform',[Controller::class,'Tampilformpost']);
Route::post('terimadata',[Controller::class,'Terimadatapost']);

Route::get("latihan01",[ControllerData::class,'latihan01']);

Route::get('konversifahrenheitView', function () {
    return view('konversiFahrenheit');
});

Route::get('konversiMeterView', function () {
    return view('konversiMeter');
});

Route::get('hitungdiskonView', function () {
    return view('hitungDiskon');
});

Route::get('hitungnilaiakhir', function () {
    return view('hitungNilaiAkhir');
});

Route::post('konversifahrenheit', [Controller::class, 'konversiFahrenheitKeCelsius']);
Route::post('konversimeter', [Controller::class, 'konversiMeterKeSentimeter']);
Route::post('hitungdiskon', [Controller::class, 'hitungDiskon']);
Route::post('hitungnilaiakhir', [Controller::class, 'hitungNilaiAkhir']);

