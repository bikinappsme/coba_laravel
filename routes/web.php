<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProjectController;


Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/crud', [ProjectController::class, 'index'])->name('crud.index');
Route::post('/crud/store', [ProjectController::class, 'store'])->name('crud.store');
Route::put('/crud/update/{id}', [ProjectController::class, 'update'])->name('crud.update');
Route::delete('/crud/destroy/{id}', [ProjectController::class, 'destroy'])->name('crud.destroy');


 Route::get('/about', function () {
     return view('about');
 });


 Route::get('/contact', function () {
     return view('contact');
 });