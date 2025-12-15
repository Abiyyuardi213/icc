<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/home', [HomeController::class, 'home'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register-account', [AuthController::class, 'showRegister'])->name('register.account'); // User Registration
Route::post('/register-account', [AuthController::class, 'register']);

Route::get('/register', [TeamController::class, 'create'])->name('team.register');
Route::post('/register', [TeamController::class, 'store']);
Route::get('/team/edit', [TeamController::class, 'edit'])->name('participants.edit'); // Match legacy name
Route::put('/team/update', [TeamController::class, 'update'])->name('participants.update');

Route::get('/detail-event', function () {
    return view('detail_Event');
})->name('event.detail');

Route::get('/list-event', function () {
    return view('list_event');
})->name('event.list');

Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
Route::resource('role', RoleController::class);
