<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::get('/register', [TeamController::class, 'create'])->name('team.register');
Route::post('/register', [TeamController::class, 'store']);

Route::get('/detail-event', function () {
    return view('detail_Event'); // Nama file blade Anda tanpa .blade.php
});
Route::get('/list-event', function () {
    return view('list_event'); // Nama file blade Anda tanpa .blade.php
});
