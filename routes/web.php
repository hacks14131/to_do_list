<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

 Route::inertia('/', 'Home')->name('all-tasks');
 Route::inertia('/priority', 'Priority')->name('prioritized-tasks');
 Route::inertia('/completed', 'Completed')->name('completed-tasks');

 Route::inertia('/register', 'Auth/Register')->name('register_user');
 Route::post('/register', [AuthController::class, 'addNewUser']);