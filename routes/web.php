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
use App\Models\Review;

Route::get('/', 'HomeController@index');

/**
 * Route Admin
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('manager-book', 'Admin\BookController');
    Route::resource('manager-user', 'Admin\UserController');
    Route::delete('manager-user', 'Admin\UserController@destroyAll');
    Route::post('manager-book/delete-anything', 'Admin\BookController@deleteAnything');
    Route::get('request-book', 'Admin\RequestBookController@index');
    Route::post('ajax-accecpt-request-book', 'Admin\RequestBookController@ajaxAccepted');
    Route::post('delete-request-book', 'Admin\RequestBookController@delete');
});
Auth::routes();


/**
 * Route Book
 */
Route::get('book/{slug}', 'Web\BookController@index');

/**
 * Route Ajax
 */
Route::post('ajax-favorite-book', 'Web\BookController@ajaxFavoriteBook');
Route::post('ajax-status-read-book', 'Web\BookController@ajaxStatusBook');
Route::get('add-like-review/{id}', 'Web\ReviewController@likeReivew');
Route::post('ajax-relationship-user', 'Web\UserController@ajaxRelationship');
Route::post('ajax-cancel-request-book', 'Web\UserController@ajaxCancelRequestBook');

/**
 * Route Review
 */
Route::post('add-reivew', 'Web\ReviewController@store');
Route::post('add-comment-reivew', 'Web\ReviewController@handleComment');

/**
 * Route Profile User
 */
Route::get('profile/{id}/{tabCurrent?}', 'Web\UserController@show');
Route::post('store-request-book', 'Web\UserController@storeRequestBook');
Route::put('update-profile/{id}', 'Web\UserController@update');

/**
 * Search
 */
Route::get('search/book', 'Web\SearchController@handleSearch');
//suggestion word
Route::get('find', 'Web\SearchController@find');
Route::get('test', function () {
    dd(preg_match('#default#', 'default_book_1.png'));
    //dd(App\Models\Book::search('312')->get());
  // return view('web.search.index');
});
