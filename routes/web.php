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

Route::get('/', 'home@index')->middleware("auth.user");
Route::get('/books/find', 'home@findBooks');
Route::get('/cart', 'home@loadCart')->middleware("auth.login");
Route::get('/cart/remove/{id}', 'home@remoteToCart')->middleware("auth.login");
Route::get('/cart/add/{id}', 'home@addToCart')->middleware("auth.login");

Route::get('/admin', 'admin@index')->middleware("auth.admin");
Route::post('/book', 'admin@book')->middleware("auth.admin");
Route::get('/books/edit/{id}', 'admin@updateBookView')->middleware("auth.admin");
Route::post('/books/edit/{id}', 'admin@updateBook')->middleware("auth.admin");
Route::get('/books/delete/{id}', 'admin@deleteBook')->middleware("auth.admin");
Route::get('/books/restore/{id}', 'admin@restoreBook')->middleware("auth.admin");


Route::get('/manager-book', 'admin@managerBooks')->middleware("auth.admin");

Route::get('/login', 'admin@login_form');
Route::post('/login', 'admin@login_form_post');

Route::get('/register', 'admin@register_form');
Route::post('/register', 'admin@register_form_post');

Route::get('/logout', 'admin@logout');