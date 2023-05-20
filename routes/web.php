<?php

use Illuminate\Support\Facades\Auth;
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

Route::prefix('penjual')->middleware(['auth', 'isPenjual'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Penjual\PenjualController::class, 'index']);

    Route::controller(App\Http\Controllers\Penjual\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::get('/category/{category}/edit', 'edit');
        Route::post('/category', 'store');
        Route::put('/category/{category}', 'update');
    });

    Route::controller(App\Http\Controllers\Penjual\ProductController::class)->group(function () {
		Route::get('/products', 'index');
		Route::get('/products/create', 'create');
		Route::post('/products', 'store');
		Route::get('/products/{product}/edit', 'edit');
		Route::put('/products/{product}', 'update');
		Route::get('/products/{product_id}/delete', 'destroy');
		Route::get('product-image/{product_image_id}/delete', 'destroyImage');
	});

    Route::controller(App\Http\Controllers\Penjual\SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/{slider}/delete', 'destroy');
    });
});

Route::controller(App\Http\Controllers\Pembeli\PembeliController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/collections', 'categories');
	Route::get('/collections/{category_slug}', 'products');
});
