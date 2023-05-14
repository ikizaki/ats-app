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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('penjual')->middleware(['auth','isPenjual'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Penjual\PenjualController::class, 'index']);
});
Route::controller(App\Http\Controllers\Pembeli\PembeliController::class)->group(function () {
	Route::get('/', 'index');
});
