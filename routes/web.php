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
				Route::get('/detail/{uuid}','OrganizationController@detail')->name('admin.management.organization.detail');
				Route::get('/datatable','OrganizationController@datatable')->name('admin.management.organization.datatables');
				Route::get('/datatable-column','OrganizationController@getDatatableColumn')->name('admin.management.organization.datatablesColumn');
			});

			Route::group(['prefix'=>'user'],function(){
				Route::get('/','UserController@index')->name('admin.management.user.index');
				Route::get('/form/{uuid?}','UserController@formManagement')->name('admin.management.user.form');
				Route::post('/','UserController@postManagement')->name('admin.management.user.post');
				Route::delete('/','UserController@delete')->name('admin.management.user.delete');
				Route::get('/datatable','UserController@datatable')->name('admin.management.user.datatables');
				Route::get('/datatable-organization','UserController@datatableOrganization')->name('admin.management.user.datatablesOrganization');
				Route::get('/datatable-column-organization','UserController@getDatatableColumnOrganization')->name('admin.management.user.datatablesColumnOrganization');
				Route::get('/datatable-column','UserController@getDatatableColumn')->name('admin.management.user.datatablesColumn');
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
			Route::post('/menu','MenuController@select2')->name('admin.management.menu.select2');
			Route::post('/role','RoleController@select2')->name('role.select2');
			Route::post('/organization','OrganizationController@select2')->name('organization.select2');
		});

	});
});
Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
	Route::post('/','AuthController@auth')->name('auth');
});

