<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
	'uses' => 'PageController@index',
	'as' => 'home'
]);

/**
 * USERS
 */
Route::get('/user/login',array(
	'as' => 'user.login',
	'uses' => 'Auth\LoginController@showLoginForm'
));
Route::post('/user/login',array(
	'as' => 'user.loginPost',
	'uses' => 'Auth\LoginController@login'
));
Route::get('/user/logout',array(
	'as' => 'user.logout',
	'uses' => 'Auth\LoginController@logout'
));
Route::get('/user/signup',array(
	'as' => 'user.signup',
	'uses' => 'Auth\RegisterController@showRegistrationForm'
));
Route::post('/user/signup',array(
	'as' => 'user.signupPost',
	'uses' => 'Auth\UserAuthController@register'
));
Route::get('/user/forgot-password', array(
	'as' => 'user.forgotPassword',
	'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
));
Route::post('/user/forgot-password', array(
	'as' => 'user.forgotPasswordPost',
	'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
));
Route::get('/user/reset-password/{token}', array(
	'as' => 'user.resetPassword',
	'uses' => 'Auth\ResetPasswordController@showResetForm'
));
Route::post('/user/reset-password', array(
	'as' => 'user.resetPasswordPost',
	'uses' => 'Auth\ResetPasswordController@reset'
));

Route::group(['middleware' => 'auth'], function(){

	Route::get('/home', array(
		'uses' => 'HomeController@index',
		'as' => 'home'
	));

	Route::group(['middleware' => 'permission:edit_departments'], function(){
		Route::get('/departments', array(
			'uses' => 'DepartmentController@index',
			'as' => 'departments.index'
		));
		Route::post('/departments', array(
			'uses' => 'DepartmentController@create',
			'as' => 'departments.create'
		));
		Route::get('/departments/{id}', array(
			'uses' => 'DepartmentController@edit',
			'as' => 'departments.edit'
		));
		Route::post('/departments/{id}', array(
			'uses' => 'DepartmentController@update',
			'as' => 'departments.update'
		));
		Route::get('/departments/{id}/delete', [
			'uses' => 'DepartmentController@destroy',
			'as' => 'departments.destroy'
		]);
		Route::get('/departments/{id}/users', array(
			'uses' => 'DepartmentController@getUsers',
			'as' => 'departments.getusers'
		));
		Route::delete('/departments/{id}/removeuser/{userid}', [
			'uses' => 'DepartmentController@removeUser',
			'as' => 'departments.removeuser'
		]);
		Route::post('/departments/{id}/adduser', array(
			'uses' => 'DepartmentController@addUser',
			'as' => 'departments.adduser'
		));
	});

	Route::group(['middleware' => 'permission:edit_users'], function(){

		Route::get('/data/users', array(
			'uses' => 'Data\UsersController@get',
			'as' => 'data.users'
		));

		Route::get('/users', array(
			'uses' => 'UserController@index',
			'as' => 'users.index'
		));
		Route::get('/users/{id}', array(
			'uses' => 'UserController@show',
			'as' => 'users.show'
		));
		Route::post('/users/{id}', array(
			'uses' => 'UserController@update',
			'as' => 'users.update'
		));
		Route::post('/users', array(
			'uses' => 'UserController@create',
			'as' => 'users.create'
		));
		Route::delete('/users/remove/{id}', array(
			'uses' => 'UserController@destroy',
			'as' => 'users.destroy'
		));

	});

	Route::group(['middleware' => 'permission:edit_roles'], function(){

		Route::get('/data/roles', array(
			'uses' => 'Data\RolesController@get',
			'as' => 'data.roles'
		));
		Route::post('/data/roles/{id}/adduser', array(
			'uses' => 'Data\RolesController@addUser',
			'as' => 'data.roles.adduser'
		));
		Route::delete('/data/roles/{id}/removeuser/{userid}', array(
			'uses' => 'Data\RolesController@removeUser',
			'as' => 'data.roles.removeuser'
		));
		
		Route::get('/roles', array(
			'uses' => 'RoleController@index',
			'as' => 'roles.index'
		));
		Route::post('/roles', array(
			'uses' => 'RoleController@create',
			'as' => 'roles.create'
		));
		Route::get('/roles/{id}', array(
			'uses' => 'RoleController@show',
			'as' => 'roles.show'
		));
		Route::post('/roles/{id}', array(
			'uses' => 'RoleController@update',
			'as' => 'roles.update'
		));
		Route::get('/roles/{id}/delete', array(
			'uses' => 'RoleController@destroy',
			'as' => 'roles.destroy'
		));

	});

	Route::group(['middleware' => 'permission:edit_projects'], function(){

		Route::get('/projects', array(
			'uses' => 'ProjectController@index',
			'as' => 'projects.index'
		));
		Route::post('/projects', array(
			'uses' => 'ProjectController@create',
			'as' => 'projects.create'
		));

		Route::get('/projects/{id}', array(
			'uses' => 'ProjectController@show',
			'as' => 'projects.show'
		));
		Route::post('/projects/{id}', array(
			'uses' => 'ProjectController@update',
			'as' => 'projects.update'
		));

	});

});

