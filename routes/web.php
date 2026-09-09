<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; #Praktikum 2

Route::get('/', function () {
    return view('welcome');
});
#=============================================================================================================
# Praktikum 2
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
# Tugas Praktikum 2
Route::get('/about', function () {
    return view('about');
})->name('about');
#=============================================================================================================
