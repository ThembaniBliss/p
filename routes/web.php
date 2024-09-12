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


Auth::routes();

Route::get('/', 'AdminController@index' )->name('home')->middleware('auth');

Route::get('/home','AdminController@index' )->name('home')->middleware('auth');


Route::get('/admin','AdminController@index');

Route::resource('owner', 'OwnerController');

Route::resource('student', 'StudentController');

Route::resource('property', 'PropertyController');
Route::get('approveProperty', 'PropertyController@approve');

Route::resource('location', 'LocationController');

Route::resource('label', 'LabelController');

Route::resource('order', 'OrderController');
Route::get('approveOrder', 'OrderController@approve');

Route::resource('image', 'ImageController');

Route::resource('gallery', 'GalleryController');

Route::resource('property-label', 'PropertyLabelController');

