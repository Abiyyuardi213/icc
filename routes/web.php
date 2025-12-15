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
    Route::get('/dashboard', [App\Http\Controllers\UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/user/events', function () {
        return view('user.event.index'); // View now handles fetching teams
    })->name('user.events.index');

    // Route::get('/user/inbox', function () {
    //     return view('user.inbox.index');
    // })->name('user.inbox.index'); // Legacy, merged into Notifications

    // Notifications (serving as Inbox)
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.readAll');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Event Tasks (User Side)
    Route::get('/user/tasks/{id}', [App\Http\Controllers\UserTaskController::class, 'show'])->name('user.tasks.show');
    Route::post('/user/tasks/{id}/submit', [App\Http\Controllers\UserTaskController::class, 'store'])->name('user.tasks.store');
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
    Route::get('/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');

    // Manage Users
    Route::resource('user', UserController::class);

    // Manage Events
    Route::resource('event', App\Http\Controllers\AdminEventController::class);
    Route::post('event/{id}/toggle-status', [App\Http\Controllers\AdminEventController::class, 'toggleStatus'])->name('event.toggleStatus');

    Route::resource('team', App\Http\Controllers\AdminTeamController::class);

    // Event Tasks Management
    Route::prefix('events/{event}')->name('event.')->group(function () {
        Route::get('tasks', [App\Http\Controllers\AdminTaskController::class, 'index'])->name('tasks.index');
        Route::get('tasks/create', [App\Http\Controllers\AdminTaskController::class, 'create'])->name('tasks.create');
        Route::post('tasks', [App\Http\Controllers\AdminTaskController::class, 'store'])->name('tasks.store');
        Route::get('tasks/{task}/edit', [App\Http\Controllers\AdminTaskController::class, 'edit'])->name('tasks.edit');
        Route::put('tasks/{task}', [App\Http\Controllers\AdminTaskController::class, 'update'])->name('tasks.update');
        Route::delete('tasks/{task}', [App\Http\Controllers\AdminTaskController::class, 'destroy'])->name('tasks.destroy');
    });
});
