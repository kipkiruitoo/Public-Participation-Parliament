<?php
use Illuminate\Support\Facades\Route;



Route::get('/', 'HomeController@discuss');
Route::get('/participate', 'HomeController@participate');
Route::get('/discuss', 'HomeController@discuss');

Auth::routes(['verify' => true]);

Route::prefix('manage')->middleware('role:superadministrator|administrator')->group(function () {
    Route::get('/', 'ManageController@index');
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
    Route::get('/dashboard', 'ManageController@dashboard')->name('manage.dashboard');
    Route::resource('/users', 'Usercontroller');
    Route::resource('/bill', 'BillsController');
    Route::resource('/petitions', 'PetitionController');
    Route::resource('/sections', 'ClauseController');
    
});
Route::get('/bill/view/{bill}', 'BillsController@viewpdf')->name('viewpdf');
Route::get('/profile', 'UserController@profile');
Route::post('/profile', 'UserController@updateavatar');

Route::put('/updateprofile/{id}', 'UserController@updateprofile')->name('updateprofile');
Route::patch('/updateprofile/{id}', 'UserController@updateprofile')->name('updateprofile');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sentiment', 'SentimentController@sentiment');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});
Route::get('search/users', 'UserSearchController@index');

Route::get('search/discussion', 'DiscussionSearchController@index');
Route::get('search/post', 'PostSearchController@index');



