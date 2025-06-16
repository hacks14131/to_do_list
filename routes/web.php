<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function() {
    Route::inertia('/', 'Home')->name('all-tasks');
    Route::inertia('/priority', 'Priority')->name('prioritized-tasks');
    Route::inertia('/completed', 'Completed')->name('completed-tasks');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('guest')->group(function() {

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

});

