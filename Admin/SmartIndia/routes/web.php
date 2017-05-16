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
Route::post('member_login', 'WebServiceController@member_login');
Route::post('register', 'WebServiceController@register');
Route::post('add_team', 'WebServiceController@add_team');
Route::post('list_teams', 'WebServiceController@list_teams');
Route::post('add_member', 'WebServiceController@add_member');
Route::post('list_members', 'WebServiceController@list_members');
Route::post('add_topics', 'WebServiceController@add_topics');
Route::get('list_topics', 'WebServiceController@list_topics');

Route::get('list_notifications', 'WebServiceController@list_notifications');
Route::post('select_team_topic', 'WebServiceController@select_team_topic');
Route::post('add_feedback', 'WebServiceController@add_feedback');


//backoofice

Route::get('user/login', 'UserController@login');
Route::post('user/signin', 'UserController@signin');
Route::get('logout', 'UserController@logout');
Route::get('index','BackofficeController@getIndex');
Route::get('users/list','BackofficeController@listUsers');
Route::get('users/data','BackofficeController@getData');
Route::get('users/delete/{id}','BackofficeController@deleteUser');
Route::get('users/activate/{id}','BackofficeController@activateUser');

Route::get('listTeamDetails/{id}','BackofficeController@listTeamDetails');
Route::get('listmembers/{id}','BackofficeController@listmembers');



Route::get('topics/list','BackofficeController@listTopics');
Route::get('topics/data','BackofficeController@topicsData');
Route::get('topics/add','BackofficeController@add_topic');
Route::post('topic/save','BackofficeController@save_topic');
Route::get('topic/edit/{id}','BackofficeController@edit_topic');
Route::post('topic/update','BackofficeController@update_topic');
Route::get('topic/delete/{id}','BackofficeController@delete_topic');


Route::get('feedback/userfeedbacklist','BackofficeController@userFeedbacklist');
Route::get('userfeedback/data','BackofficeController@userFeedbackData');
Route::get('feedback/teamfeedbacklist','BackofficeController@teamFeedbacklist');
Route::get('teamfeedback/data','BackofficeController@teamFeedbackData');
Route::get('feedback/delete/{id}','BackofficeController@delete_feedback');
Route::get('feedback/view/{id}','BackofficeController@view_feedback');


Route::post('push_image', 'WebServiceController@push_image');
Route::post('register_notifications', 'WebServiceController@register_notifications');
Route::post('unregister_notifications', 'WebServiceController@unregister_notifications');
