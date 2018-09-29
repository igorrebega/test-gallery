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

Route::get('/', 'GalleryController@index')->name('home');
Route::get('/gallery/create', 'GalleryController@create')->name('gallery.crete');
Route::post('/gallery/store', 'GalleryController@store')->name('gallery.store');
Route::get('/gallery/edit/{id}', 'GalleryController@edit')->name('gallery.edit');
Route::post('/gallery/update/{id}', 'GalleryController@update')->name('gallery.update');
Route::get('/gallery/delete/{id}', 'GalleryController@delete')->name('gallery.delete');


Route::post('/photo/upload', 'PhotoController@upload')->name('photo.upload');
Route::get('/photo/delete/{galleryId}/{id}', 'PhotoController@delete')->name('photo.delete');
Route::get('/photo/makeCover/{galleryId}/{id}', 'PhotoController@makeCover')->name('photo.makeCover');