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
Route::resource('/company', \App\Http\Controllers\Pages\CompanyController::class,
    ['only' => ['index', 'create', 'show', 'edit']])
    ->names(['index' => 'company', 'create' => 'company.create', 'show' => 'company.show', 'edit' => 'company.edit']);
Route::resource('/employee', \App\Http\Controllers\Pages\EmployeeController::class,
    ['only' => ['index', 'create', 'show', 'edit']])
    ->names(['index' => 'employee', 'create' => 'employee.create', 'show' => 'employee.show', 'edit' => 'employee.edit']);

require __DIR__.'/auth.php';
