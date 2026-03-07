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

Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\WebController::class, 'index'])->name('home');

Route::get('/contact', [App\Http\Controllers\WebController::class, 'contact'])->name('contact');
Route::post('/addcontact', [App\Http\Controllers\WebController::class, 'addcontact'])->name('addcontact');

Route::get('/admin', [App\Http\Controllers\WebController::class, 'admin'])->name('admin');

Route::get('/profile', [App\Http\Controllers\WebController::class, 'profile'])->name('profile');

Route::post('/addCategory', [App\Http\Controllers\WebController::class, 'addCategory'])->name('addCategory');
Route::delete('/delCategory', [App\Http\Controllers\WebController::class, 'delCategory'])->name('delCategory');
Route::post('/addProducts', [App\Http\Controllers\WebController::class, 'addProducts'])->name('addProducts');
Route::delete('/delProducts/{id}', [App\Http\Controllers\WebController::class, 'delProducts'])->name('delProducts');
Route::get('/editProductsView/{id}', [App\Http\Controllers\WebController::class, 'editProductsView'])->name('editProductsView');
Route::post('/editProducts/{id}', [App\Http\Controllers\WebController::class, 'editProducts'])->name('editProducts');

Route::get('/catalog', [App\Http\Controllers\WebController::class, 'catalog'])->name('catalog');
Route::get('/card/{id}', [App\Http\Controllers\WebController::class, 'card'])->name('card');

Route::get('/reg', [App\Http\Controllers\WebController::class, 'reg'])->name('reg');
Route::get('/magazin', [App\Http\Controllers\WebController::class, 'magazin'])->name('magazin');
