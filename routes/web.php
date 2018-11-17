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
			Route::get('/','AdminController@index')->name('admin.index');
			Route::get('/logout','AdminController@logout')->name('admin.logout');
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

			//organizations

			Route::group(['prefix'=>'organization'],function(){
				Route::get('/','OrganizationController@index')->name('admin.management.organization.index');
				Route::get('/form/{uuid?}','OrganizationController@form')->name('admin.management.organization.form');
				Route::post('/','OrganizationController@post')->name('admin.management.organization.post');
				Route::delete('/','OrganizationController@delete')->name('admin.management.organization.delete');
				Route::get('/datatable','OrganizationController@datatable')->name('admin.management.organization.datatables');
				Route::get('/datatable-column','OrganizationController@getDatatableColumn')->name('admin.management.organization.datatablesColumn');
			});

			Route::group(['prefix'=>'role'],function(){
				Route::get('/','RoleController@index')->name('admin.management.role.index');
				Route::get('/form/{uuid?}','RoleController@form')->name('admin.management.role.form');
				Route::post('/','RoleController@post')->name('admin.management.role.post');
				Route::delete('/','RoleController@delete')->name('admin.management.role.delete');
				Route::get('/datatable','RoleController@datatable')->name('admin.management.role.datatables');
				Route::get('/datatable-column','RoleController@getDatatableColumn')->name('admin.management.role.datatablesColumn');
			});
		});
		Route::group(['prefix'=>'select2'],function(){
			Route::post('/','MenuController@select2')->name('admin.management.menu.select2');			
		});

	});
});

