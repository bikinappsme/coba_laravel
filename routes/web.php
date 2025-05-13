<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index']);




 Route::get('/about', function () {
     return view('about');
 });


 Route::get('/contact', function () {
     return view('contact');
 });