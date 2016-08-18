<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('create_topic', function () {
    return view('create_topic');
});
Route::get('on_demand', function () {
    return view('on_demand');
});
Route::get('if_not_pinged', function () {
    return view('not_pinged');
});
Route::post('create_topic_on_demand', [
    'as' => 'on_demand_store', 'uses' => 'MainController@add_on_demand'
]);
Route::post('create_topic_not_pinged', [
    'as' => 'not_pinged_store', 'uses' => 'MainController@add_not_pinged'
]);
Route::get('dashboard', [
    'as' => 'dashboard', 'uses' => 'MainController@dashboard'
]);
