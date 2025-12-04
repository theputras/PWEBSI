<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ControllerData;
// use App\Http\Controllers\AnggotaController;  // akses controller lain
use App\Http\Controllers\BarangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ControllerPertemuan9;


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

// Rute untuk menampilkan form input Blade
Route::get('/tugas/blade/input', [TugasController::class, 'showBladeForm'])->name('blade.input');

// Rute untuk memproses data dari form dan menampilkan output
Route::post('/tugas/blade/output', [TugasController::class, 'processBladeForm'])->name('blade.output');

// Rute untuk menampilkan form input jQuery
Route::get('/tugas/jquery/input', [TugasController::class, 'showJqueryForm'])->name('jquery.input');

// Rute untuk menampilkan output dari data yang dikirim via URL
Route::get('/tugas/jquery/output', [TugasController::class, 'processJqueryForm'])->name('jquery.output');

Route::get('hitungnilaiakhir', function () {
    return view('hitungNilaiAkhir');
});

Route::post('konversifahrenheit', [Controller::class, 'konversiFahrenheitKeCelsius']);
Route::post('konversimeter', [Controller::class, 'konversiMeterKeSentimeter']);
Route::post('hitungdiskon', [Controller::class, 'hitungDiskon']);
Route::post('hitungnilaiakhir', [Controller::class, 'hitungNilaiAkhir']);



// Week 5
Route::get('/tampil', [Controller::class, 'PenampilanControl']);

Route::get('barang', [BarangController::class, 'readbarang']);
Route::get('barang/tambah', [BarangController::class, 'tambahbarang']);
Route::post('barang/simpan', [BarangController::class, 'simpanbarang']);
Route::get('barang/hapus/{kodebr}', [BarangController::class, 'hapusbarang']);
Route::get('barang/edit/{kodebr}', [BarangController::class, 'editbarang']);
Route::post('barang/editt', [BarangController::class, 'edittbarang']);
Route::get('barang/cari/{cari}', [BarangController::class, 'caribarang']);


// Praktikum 4 (TUGAS)
Route::get('/segitiga', [TugasController::class, 'indexSegitiga'])->name('segitiga.index');
Route::post('/segitiga/hitung', [TugasController::class, 'hitung'])->name('segitiga.hitung');
Route::get('/tugas90', [ControllerPertemuan9::class, 'tugas90']);
Route::get('/tugasDiskon', [ControllerPertemuan9::class, 'tugasDiskon']);
Route::get('/tugasSelect', [ControllerPertemuan9::class, 'tugasSelect']);

// Route::post('/order/total', [OrderController::class, 'total']);
