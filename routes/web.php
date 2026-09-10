<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; #Praktikum 2
use App\Http\Controllers\Auth\LoginController; #Praktikum 4

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
#Praktikum 4
Route::get('/login', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
#Middleware CheckRole
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('report.sales');
    #Tugas Praktikum 4
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:admin,kasir'])->group(function () {
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos', [PosController::class, 'store'])->name('pos.store');
});
#=============================================================================================================