<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('manager-book', 'Admin\BookController');
    Route::post('manager-book/delete-anything', 'Admin\BookController@deleteAnything');
    Route::get('request-book', 'Admin\RequestBookController@index');
    Route::post('ajax-accecpt-request-book', 'Admin\RequestBookController@ajaxAccepted');
    Route::post('delete-request-book', 'Admin\RequestBookController@delete');
});
Auth::routes();
