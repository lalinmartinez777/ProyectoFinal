<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/welcome-admin', function () {
    return view('welcome-admin');
})->name('admin.welcome');

Route::get('/welcome-student', function () {
    return view('welcome-student');
})->name('student.welcome');
