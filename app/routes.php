<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	if(!Session::has('uid')) {
		return View::make('admin.login');
	}else {
		return Redirect::route('dashboard');
	}
});

Route::get('login', function()
{
	return View::make('admin.login');
});

Route::post('login', 'AdminController@login');

Route::get('logout', 'AdminController@logout');

Route::get('register', function()
{
	return View::make('admin.register');
});

Route::post('register', 'AdminController@register');

Route::post('post_register', 'AdminController@post_register');

Route::get('dashboard', array('as' => 'dashboard', function()
{
	if(!Session::has('uid'))
		return Redirect::to('/');

	return View::make('admin.dashboard', array('page' => 'dashboard'));	
}));



Route::get('teacher/register', function()
{
    return View::make('teacher.register');
});

Route::post('teacher/register', 'TeacherController@register');

Route::get('teacher/confirm/{user}/{key}', function($user, $key)
{
	return View::make('teacher.confirm', array('user' => $user, 'key' => $key));
});

Route::post('teacher/confirm', 'TeacherController@confirm');




Route::get('student/register', function()
{
    return View::make('student.register');
});

Route::post('student/register', 'StudentController@register');

Route::get('student/confirm/{user}/{key}', function($user, $key)
{
    return View::make('student.confirm', array('user' => $user, 'key' => $key));
});

Route::post('student/confirm', 'StudentController@confirm');




Route::get('reports', function()
{
	return View::make('reports');
});

Route::get('messages', function()
{
	return View::make('messages');
});

Route::get('media', function()
{
	return View::make('media');
});

Route::get('forgotPassword', function()
{
	return View::make('forgotPassword');
});

Route::get('alerts', function()
{
	return View::make('alerts');
});
