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
	return View::make('hello');
});

/* Protected Routes */
Route::api(['version' => 'v1', 'prefix' => '', 'protected' => true], function()
{
    /* User system */
    Route::resource('users',                    'UsersController', array('except' => array('update', 'destroy')));
    Route::patch('users',                       'UsersController@update');
    Route::patch('users',                       'UsersController@destroy');


    /* Events */
    Route::resource('events',                   'EventsController');

    /* Event Tags */
    Route::resource('event_tags',               'EventTagsController');

    /* Activity Log */
    Route::resource('activity',                 'ActivitiesController');
});

/* Public Routes */
Route::api(['version' => 'v1', 'prefix' => ''], function()
{
    /* User system */
    Route::get( 'register',                     'UsersController@store');
    Route::get( 'register/confirm/{code}',      'UsersController@confirm');
    Route::post('login/forgot',                 'UsersController@remind');
    Route::post('login/reset',                  'UsersController@reset');
});
