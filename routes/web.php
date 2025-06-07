<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});
Route::get('/priority', function() { 
    return Inertia::render('Priority');
 });
Route::get('/completed', function() { 
    return Inertia::render('Completed');
 });
