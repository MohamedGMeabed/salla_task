<?php

use App\Http\Controllers\Admin\MainPageController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/dashboard', function () {
    return view('dashboard');
});
Route::get('/login', function () {
    return view('auth.login');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'products' ], function () {
    Route::get('/',[ProductController::class , 'index'])->name('products.index');
    Route::get('/data',[ProductController::class , 'data'])->name('products.data');
    Route::get('/create',[ProductController::class , 'create'])->name('products.create');
    Route::post('/store',[ProductController::class , 'store'])->name('products.store');
    Route::get('/edit/{product}',[ProductController::class , 'edit'])->name('products.edit');
    Route::post('/update',[ProductController::class , 'update'])->name('products.update');
    Route::post('/delete',[ProductController::class , 'delete'])->name('products.delete');
    Route::post('/pullData',[ProductController::class , 'pullData'])->name('products.pullData');
});

