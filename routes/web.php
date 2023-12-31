<?php

use App\Http\Controllers\FruitController;
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

// Routes for fruits
Route::get('/fruits', [FruitController::class, 'index'])->name('fruits.index');
Route::get('/fruits/{id}', [FruitController::class, 'edit'])->name('fruits.edit');
Route::put('/fruits/{id}', [FruitController::class, 'update'])->name('fruits.update');
Route::delete('/fruits/{id}', [FruitController::class, 'destroy'])->name('fruits.destroy');
