<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     sleep(2)
//     return Inertia::render('Home');
// });

 Route::inertia('/', 'Home')->name('all-tasks');
 Route::inertia('/priority', 'Priority')->name('prioritized-tasks');
 Route::inertia('/completed', 'Completed')->name('completed-tasks');