<?php

use App\Http\Controllers\DetailkirimController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MasterkirimController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StorageProxyController;
use Illuminate\Support\Facades\Route;

// Landing -> Pengiriman
Route::get('/', fn() => redirect()->route('masterkirim.index'))->name('home');

// Master data
Route::resource('gudang', GudangController::class);
Route::resource('produk', ProdukController::class);
Route::resource('kendaraan', KendaraanController::class);

// Transaksi pengiriman (header)
Route::resource('masterkirim', MasterkirimController::class);

// Detail pengiriman (nested lines)
Route::get('masterkirim/{kodekirim}/detail', [DetailkirimController::class, 'index'])->name('detailkirim.index');
Route::post('masterkirim/{kodekirim}/detail', [DetailkirimController::class, 'store'])->name('detailkirim.store');
Route::put('masterkirim/{kodekirim}/detail/{kodeproduk}', [DetailkirimController::class, 'update'])->name('detailkirim.update');
Route::delete('masterkirim/{kodekirim}/detail/{kodeproduk}', [DetailkirimController::class, 'destroy'])->name('detailkirim.destroy');

Route::get('storage/{path}', [StorageProxyController::class, 'show'])
    ->where('path', '.*')
    ->name('storage.proxy');
