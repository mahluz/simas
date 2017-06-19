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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin','AdminController@index');

Route::group(['prefix'=>'admin'],function(){

	Route::get('mitra','MitraController@index');
	Route::group(['prefix'=>'mitra'],function(){
		Route::post('store','MitraController@store');
		Route::post('delete','MitraController@delete');
		Route::post('update','MitraController@update');
		Route::post('getValue','MitraController@getValue');
	});

	Route::get('statistik','StatistikController@index');
	Route::group(['prefix'=>'statistik'],function(){
		
	});

	Route::get('kegiatan','KegiatanController@index');
	Route::group(['prefix'=>'kegiatan'],function(){
		Route::post('store','KegiatanController@store');
		Route::post('delete','KegiatanController@delete');
		Route::post('update','KegiatanController@update');
	});

});
