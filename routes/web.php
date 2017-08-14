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

//Auth::Routes();

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']);
Route::get('/about', ['as' => 'about', 'uses' => 'HomeController@about']);

Route::any('/users/import', ['as' => 'users.import', 'uses' => 'UserController@import']);
//Route::post('/users/import', ['as' => 'users.do_import', 'uses' => 'UserController@do_import']);
Route::resource('users', 'UserController');

Route::any('/guard/weekly', ['as' => 'guard.weekly', 'uses' => 'GuardController@weekly']);
Route::any('/guard/midterm', ['as' => 'guard.midterm', 'uses' => 'GuardController@midterm']);
Route::any('/guard/patrol', ['as' => 'guard.patrol', 'uses' => 'GuardController@patrol']);
Route::any('/guardian_table/weekly', ['as' => 'guardian_table.weekly', 'uses' => 'GuardianTableController@weekly']);
Route::any('/guardian_table/midterm', ['as' => 'guardian_table.midterm', 'uses' => 'GuardianTableController@midterm']);
Route::any('/guardian_table/patrol', ['as' => 'guardian_table.patrol', 'uses' => 'GuardianTableController@patrol']);
Route::post('/guardian_table/change_guard', ['as' => 'guardian_table.change_guard', 'uses' => 'GuardianTableController@change_guard']);
