<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::middleware('auth')->group(function() {
    Route::get('/', [TaskController::class, 'index'])->name('all-tasks');
    Route::post('/add-new-tasks', [TaskController::class, 'addNewTask']);
    Route::patch('/tasks/{task}', [TaskController::class, 'update']);
    Route::patch('/task/{task}/prioritize', [TaskController::class, 'prioritizeTask'])->name('tasks.prioritize');
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'markAsDone'])->name('tasks.complete');
    Route::delete('/tasks/{task}', [TaskController::class, 'removeTask'])->name('tasks.destroy');

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

