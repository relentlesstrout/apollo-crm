<?php

use App\Http\Controllers\FAQController;
use Illuminate\Support\Facades\Route;

Route::get('/faqs', [FAQController::class, 'index']);
