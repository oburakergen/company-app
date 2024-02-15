<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\Pages\HomeController::class)->name('home');
Route::get('/company/{id}', \App\Http\Controllers\Pages\CompanyController::class)->name('company');
Route::get('/dashboard',\App\Http\Controllers\DashboardController::class)->name('dashboard');


require __DIR__.'/auth.php';
