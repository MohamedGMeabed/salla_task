<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::group(['prefix' => 'products'], function () {
//     Route::get('/',[ProductController::class , 'index'])->name('products.index');
//     Route::get('/create',[ProductController::class , 'create'])->name('products.create');
//     Route::post('/store',[ProductController::class , 'store'])->name('products.store');
//     Route::get('/edit/{product}',[ProductController::class , 'edit'])->name('products.edit');
//     Route::post('/update',[ProductController::class , 'update'])->name('products.update');
//     Route::post('/delete',[ProductController::class , 'delete'])->name('products.delete');
//     Route::post('/change-status',[ProductController::class , 'changeStatus'])->name('products.changeStatus');
// });