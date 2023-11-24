<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;


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


Route::get('/upload/{id}', [FileController::class, 'index'])->name('file.index');
Route::post('/upload/{id}', [FileController::class, 'store'])->name('file.store');
Route::get('/', function () {
    return view('welcome');
});

Route::get('get_csv', [\App\Http\Controllers\CsvController::class, 'get_csv'])->name('get_csv');
Route::get('an', [\App\Http\Controllers\CsvController::class, 'launchFilter'])->name('launchFilter');
Route::get('guessing', [\App\Http\Controllers\CsvController::class, 'guesspdf'])->name('guesspdf');

Route::get('filter', [\App\Http\Controllers\FilterfileController::class, 'create'])->name('filter');

Route::post('filterStore', [\App\Http\Controllers\FilterfileController::class, 'store'])->name('filterStore');
Route::post('ClassficationStore/{id}', [\App\Http\Controllers\FilterfileController::class, 'ClassficationStore'])->name('ClassficationStore');

Route::get('filterClassfication/{id}', [\App\Http\Controllers\FilterfileController::class, 'filterClassfication'])->name('filterClassfication');

Route::get('train/{id}', [\App\Http\Controllers\CsvController::class, 'train'])->name('train');
Route::get('trainModel/{id}', [\App\Http\Controllers\CsvController::class, 'trainModel'])->name('trainModel');

Route::get('test/{id}', [\App\Http\Controllers\CsvController::class, 'test'])->name('test');
