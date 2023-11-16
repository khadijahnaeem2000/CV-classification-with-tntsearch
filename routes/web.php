<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('get_csv', [\App\Http\Controllers\CsvController::class, 'get_csv'])->name('get_csv');
Route::get('an', [\App\Http\Controllers\CsvController::class, 'launchFilter'])->name('launchFilter');
Route::get('guessing', [\App\Http\Controllers\CsvController::class, 'guesspdf'])->name('guesspdf');