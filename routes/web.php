<?php

use App\Http\Controllers\CleaningJobController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/customers/areas', [CustomerController::class, 'areas'])->name('customers.areas');

Route::get('/customers/areas/{area}/streets', [CustomerController::class, 'streets'])->name('customers.streets');

Route::get('/customers/areas/{area}/streets/{street}', [CustomerController::class, 'streetCustomers'])->name('customers.streetCustomers');

Route::resource('customers', CustomerController::class);

Route::resource('cleaningJobs', CleaningJobController::class);

Route::get('/', function () {
    return view('home');
});



