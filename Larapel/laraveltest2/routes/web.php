<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('homepage');
});


Route::get('/posting', [PostController::class, 'index']);
Route::get('/sukses/{n1}/{n2}/{n3}', [PostController::class, 'show']);

Route::get('/user/{id}', function ($id){
 return 'User ID: '. $id;
});

