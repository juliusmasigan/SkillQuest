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


Route::get('logout', function()
{
	Session::flush();
	
	return Redirect::to("/");
});


Route::get('login', function()
{
	return View::make('admin.login');
});

Route::post('login', 'AdminController@login');

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

	$user_type_arr = Session::get('user.type');
	

	if($user_type_arr[0] == 'admin')
		return View::make('admin.dashboard', array('page' => 'dashboard'));

	if($user_type_arr[0] == 'teacher')
		return View::make('teacher.dashboard', array('page' => 'dashboard'));

	if($user_type_arr[0] == 'student')
		return View::make('student.dashboard', array('page' => 'dashboard'));
}));

Route::get('students', 'AdminController@list_students');

Route::get('teachers', 'AdminController@list_teachers');



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

Route::get('teacher/login', function()
{
	return View::make('teacher.login');
});

Route::post('teacher/login', 'TeacherController@login');

Route::get('teacher/{id}', 'TeacherController@view');

Route::get('teacher/approve/{id}', 'TeacherController@approve');

Route::get('teacher/decline/{id}', 'TeacherController@decline');



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

Route::get('student/login', function()
{
	return View::make('student.login');
});

Route::post('student/login', 'StudentController@login');

Route::get('student/{id}', 'StudentController@view');

Route::get('student/approve/{id}', 'StudentController@approve');

Route::get('student/decline/{id}', 'StudentController@decline');




Route::get('reports', function()
{
	return View::make('reports', array('page' => 'reports'));
});

Route::get('messages', function()
{
	return View::make('messages', array('page' => 'messages'));
});

Route::get('media', function()
{
	return View::make('media', array('page' => 'media'));
});

Route::get('forgotPassword', function()
{
	return View::make('forgotPassword');
});

Route::get('alerts', 'AlertController@page_index');

Route::post('alerts', 'AlertController@post');

Route::get('queries', 'QueryController@page_index');

Route::post('queries', 'QueryController@post');

Route::put('queries/{id}', 'QueryController@update');

Route::post('answers', 'AnswerController@post');

Route::get('profile', function()
{
    return View::make('profile', array('page' => 'profile'));
});
