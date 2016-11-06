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
Route::get('/bruger/logind',array(
	'as' => 'userLogin',
	'uses' => 'Auth\UserAuthController@getlogin'
));
Route::post('/bruger/logind',array(
	'as' => 'userLoginPost',
	'uses' => 'Auth\UserAuthController@postLogin'
));
Route::get('/bruger/logud',array(
	'as' => 'userLogout',
	'uses' => 'Auth\UserAuthController@getLogout'
));
Route::get('/bruger/tilmeld',array(
	'as' => 'userSignup',
	'uses' => 'Auth\UserAuthController@getRegister'
));
Route::post('/bruger/tilmeld',array(
	'as' => 'userSignupPost',
	'uses' => 'Auth\UserAuthController@postRegister'
));
Route::get('/bruger/glemt-password', array(
	'uses' => 'Auth\PasswordController@getEmail',
	'as' => 'userForgotPassword'
));
Route::post('/bruger/glemt-password', array(
	'uses' => 'Auth\PasswordController@postEmail',
	'as' => 'userForgotPasswordPost'
));
Route::get('/bruger/nulstil-password/{token}', array(
	'uses' => 'Auth\PasswordController@getReset',
	'as' => 'userResetPassword'
));
Route::post('/bruger/nulstil-password', array(
	'uses' => 'Auth\PasswordController@postReset',
	'as' => 'userResetPasswordPost'
));


Auth::routes();

Route::get('/home', 'HomeController@index');
