<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\CleaningJobController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// Login routes (guest only)
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

// All authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', Logout::class)->name('logout');

    Route::resource('customers', CustomerController::class);
    Route::patch('/customers/{id}/restore', [CustomerController::class, 'restore'])
        ->name('customers.restore');

    Route::resource('cleaningJobs', CleaningJobController::class);

    Route::get('/', function () {
        return view('home');
    });

    Route::get('today', [CleaningJobController::class, 'indexToday'])->name('indexToday');
    Route::get('scheduling', [CleaningJobController::class, 'scheduling'])->name('scheduling');
});
