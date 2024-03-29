<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('companies', \App\Http\Controllers\Api\CompanyApi::class);
Route::apiResource('employees', \App\Http\Controllers\Api\EmployeeApi::class, ['except' => ['index']]);