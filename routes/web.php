<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
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

// Dashboard (protected) - render dashboard view
// Dashboard (protected) 
Route::middleware(['auth', 'role:participant'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/user/events', function () {
        return view('user.event.index', ['team' => auth()->user()->team]);
    })->name('user.events.index');

    Route::get('/user/inbox', function () {
        return view('user.inbox.index');
    })->name('user.inbox.index');
});

Route::get('/register', [TeamController::class, 'create'])->name('team.register');
Route::post('/register', [TeamController::class, 'store']);
Route::get('/team/edit', [TeamController::class, 'edit'])->name('participants.edit'); // Match legacy name
Route::put('/team/update', [TeamController::class, 'update'])->name('participants.update');

// Participants create route for dashboard link (requires authenticated user)
Route::get('/participants/create', [TeamController::class, 'create'])
    ->middleware('auth')
    ->name('participants.create');

Route::get('/list-event', [EventController::class, 'index'])->name('event.list');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('event.detail');

    Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
    Route::resource('role', RoleController::class);
    
    // User Routes moved to Admin Group

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Manage Users
    Route::resource('user', UserController::class);

    // Manage Events
    Route::resource('event', App\Http\Controllers\AdminEventController::class);
    Route::post('event/{id}/toggle-status', [App\Http\Controllers\AdminEventController::class, 'toggleStatus'])->name('event.toggleStatus');

    Route::resource('team', App\Http\Controllers\AdminTeamController::class);

    // Placeholders for future admin management features
    // Route::resource('users', AdminUserController::class);
    // Route::resource('events', AdminEventController::class);
    // Route::resource('teams', AdminTeamController::class);
});
