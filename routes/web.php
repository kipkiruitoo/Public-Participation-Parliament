<?php
use Illuminate\Support\Facades\Route;


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

Route::get('/', 'LearnController@learn');
Route::get('/participate', 'HomeController@participate');
Route::get('/discuss', 'HomeController@discuss');

Auth::routes();

Route::prefix('manage')->middleware('role:superadministrator|administrator')->group(function () {
    Route::get('/', 'ManageController@index');
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
    Route::get('/dashboard', 'ManageController@dashboard')->name('manage.dashboard');
    Route::resource('/users', 'Usercontroller');
    Route::resource('/bill', 'BillsController');
    Route::resource('/petitions', 'PetitionController');
    Route::get('/bill/view/{bill}', 'BillsController@viewpdf')->name('viewpdf');
});

Route::get('/profile', 'UserController@profile');
Route::post('/profile', 'UserController@updateavatar');

Route::put('/updateprofile', 'UserController@updateprofile')->name('updateprofile');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});
