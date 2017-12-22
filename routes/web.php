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

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	Route::group(['middleware'=>['guest']],function(){
			Route::get('/','AdminController@index');
	});
	Route::group(['middleware' => ['sentinel']],function(){
		Route::get('/redirect','AdminController@redirect')->name('admin.redirect');
		Route::get('/dashboard','AdminController@dashboard')->name('admin.dashboard');
		Route::get('/redirect','AdminController@redirect')->name('admin.redirect');

		Route::group(['prefix'=>'user'],function(){
			Route::get('/{id}','UserController@form')->name('admin.user.form');		
			Route::post('/','UserController@post')->name('admin.user.post');		
		});
	});
});

Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
	Route::post('/','AuthController@auth')->name('auth');
});


Route::group(['prefix'=>'test','namespace'=>'Test'],function(){
	Route::post('/image','ImageController@post')->name('test.image.post');
});
