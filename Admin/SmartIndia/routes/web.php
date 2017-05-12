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

Route::get('/', function () {
    return view('welcome');
});
Route::get('user/test', 'LoginController@test');

//Service 
Route::post('login', 'WebServiceController@login');
Route::post('register', 'WebServiceController@register');
Route::post('add_team', 'WebServiceController@add_team');
Route::post('list_teams', 'WebServiceController@list_teams');
Route::post('add_member', 'WebServiceController@add_member');
Route::post('list_members', 'WebServiceController@list_members');

