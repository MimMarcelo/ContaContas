<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\CurrencyController;
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
})->name('home');

/*
MUDE A PÁGINA QUE SERÁ ABERTA APÓS LOGIN NO PROVEDOR:
App\Providers\RouteServiceProvider
Propriedade HOME
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('bills', BillController::class)->middleware('auth');
// Route::resource('bills', BillController::class);
Route::resource('sources', SourceController::class)->middleware('auth');
Route::resource('currencies', CurrencyController::class)->middleware('auth');