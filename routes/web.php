<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

require __DIR__.'/auth.php';
// Route::get('/', HomeController::class);
Route::controller(HomeController::class)->group(function () {
    Route::get('/products', 'index')->name('products');
    Route::get('/products/{slug}/detail', 'detail')->name('product.detail');
    Route::get('/category/{slug}', 'showByCategory')->name('categories');
});;

Route::group(['middleware' => ['auth', 'role:super-admin|seller'], 'prefix' => 'dashboard'], function(){
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('/products', ProductController::class);
    Route::middleware(['role:super-admin'])->group(function () {
        Route::resource('/categories', CategoryController::class);
    });
});




Route::any('{any}', function (){
    return to_route('products');
});