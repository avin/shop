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

//Auth
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', ['as' => 'home', 'uses' => 'PageController@getHome']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::get('/', 'DashboardController@index');

    Route::resource('product', 'ProductController');
    Route::get('product/{id}/delete', ['as' => 'admin.product.delete', 'uses' => 'ProductController@delete']);

    Route::resource('category', 'CategoryController');
    Route::get('category/{id}/delete', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@delete']);

});

