<?php

use App\Http\Controllers\CleaningJobController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::resource('customers', CustomerController::class);

Route::get('customers/areas', [CustomerController::class, 'areas'])
    ->name('customers.areas');

Route::resource('cleaningJobs', CleaningJobController::class);

Route::get('/', function () {
    return view('home');
});



