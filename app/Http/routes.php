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

Route::group(['namespace' => 'Front'], function () {

    Route::get('/', ['as' => 'home', 'uses' => 'PageController@getHome']);
    Route::get('about', ['as' => 'home', 'uses' => 'PageController@getAbout']);
    Route::get('contact', ['as' => 'home', 'uses' => 'PageController@getContact']);


    Route::group(['prefix' => 'product'], function () {
        Route::get('/', ['as' => 'product.index', 'uses' => 'ProductController@index']);
        Route::get('random', ['as' => 'product.random', 'uses' => 'ProductController@random']);
        Route::get('{id}', ['as' => 'product.index', 'uses' => 'ProductController@show']);
        Route::get('{id}/buy', ['as' => 'product.index', 'uses' => 'ProductController@buy']);
        Route::post('{id}', ['as' => 'product.index', 'uses' => 'ProductController@storeReview']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', ['as' => 'profile.index', 'uses' => 'ProfileController@show']);
        Route::put('/', ['as' => 'profile.index', 'uses' => 'ProfileController@save']);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', ['as' => 'cart.index', 'uses' => 'CartController@show']);
        Route::put('/', ['as' => 'cart.index', 'uses' => 'CartController@save']);
        Route::get('checkout', ['as' => 'cart.index', 'uses' => 'CartController@getCheckout']);
    });


});



Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::get('/', 'DashboardController@index');

    Route::resource('product', 'ProductController');
    Route::get('product/{id}/delete', ['as' => 'admin.product.delete', 'uses' => 'ProductController@delete']);

    Route::resource('category', 'CategoryController');
    Route::get('category/{id}/delete', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@delete']);

});

