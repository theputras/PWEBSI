<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::post('/order/total', [OrderController::class, 'total']);