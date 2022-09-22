<?php

use App\Http\Controllers\CalendarioController;
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

Route::get('/', [App\Http\Controllers\CalendarioController::class, 'calendario_milenar']);

Route::get('calendario_milenar', [App\Http\Controllers\CalendarioController::class, 'calendario_milenar']);