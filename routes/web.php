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

		Route::group(['prefix'=>'management'],function(){
			Route::group(['prefix'=>'menu'],function(){
				Route::get('/','MenuController@index')->name('admin.management.menu.index');
				Route::get('/form/{uuid?}','MenuController@form')->name('admin.management.menu.form');
				Route::post('/','MenuController@post')->name('admin.management.menu.post');
				Route::delete('/','MenuController@delete')->name('admin.management.menu.delete');
				Route::get('/datatable','MenuController@datatable')->name('admin.management.menu.datatables');
				Route::get('/datatable-column','MenuController@getDatatableColumn')->name('admin.management.menu.datatablesColumn');
			});				
		});
		Route::group(['prefix'=>'select2'],function(){
			Route::post('/','MenuController@select2')->name('admin.management.menu.select2');			
		});

	});
});

Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
	Route::post('/','AuthController@auth')->name('auth');
});


Route::group(['prefix'=>'test','namespace'=>'Test'],function(){
	Route::post('/image','ImageController@post')->name('test.image.post');
});
