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

Route::match(array('GET', 'POST'), "/", array(
	'uses' => 'Mobile\TopController@init',
	'as' => 'm_topPage'
));
Route::match(array('GET', 'POST'), "/login", array(
	'uses' => 'Mobile\LoginController@login',
	'as' => 'm_login'
));
Route::match(array('GET', 'POST'), "/register", array(
	'uses' => 'Mobile\LoginController@register',
	'as' => 'm_register'
));
Route::match(array('GET', 'POST'), "/register_complete", array(
	'uses' => 'Mobile\LoginController@registerComplete',
	'as' => 'm_register_complete'
));
Route::match(array('GET', 'POST'), "/logout", array(
	'uses' => 'Mobile\LogoutController@action',
	'as' => 'm_logout'
));
