<?php

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
//============================== Router for auth
Route::get('/', 'HomeController@index')->name('home');
Route::get('/lien-he', 'HomeController@contact')->name('contact');
Route::get('/danh-muc-bai-viet/{slug}', 'HomeController@danhmuc_baiviet')->name('danhmuc.baiviet');
Route::get('/bai-viet/{slug}', 'HomeController@baiviet')->name('detail.baiviet');
Route::get('/gioi-thieu', 'HomeController@introduce')->name('introduce');
Route::get('/search', 'HomeController@search')->name('search');

Route::prefix('ajax')->group(function () {
    Route::get('/search', 'HomeController@searchAjax')->name('ajax.search');
});

//============================== Router for user
Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');
});

//============================== Router for admin
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
});
Auth::routes();
