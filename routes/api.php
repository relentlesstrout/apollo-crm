<?php

use App\Http\Controllers\FAQController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

//FAQs
Route::get('/faqs', [FAQController::class, 'index']);

//Quote Api
Route::post('/quotes', [QuoteController::class, 'store']);
