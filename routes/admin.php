<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 5/23/2018
 * Time: 8:38 PM
 */

Route::group(['prefix' => 'admin'], function() {

//    Route::get('/', function () {
//        return redirect()->route('admin.login_view');
//    });


    Route::get('login', 'Admin\AuthController@login_view')->name('admin.login_view');
    Route::post('login', 'Admin\AuthController@login')->name('admin.login');
    Route::post('register', 'Admin\AuthController@register')->name('admin.register');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');
        Route::get('/', 'Admin\AdminController@index')->name('admin.home');

        Route::post('currency/add', 'Admin\AdminController@addCurrency')->name('admin.currency.add');
        Route::post('currency/update', 'Admin\AdminController@updateCurrency')->name('admin.currency.update');
        Route::get('currency/{id}', 'Admin\AdminController@getCurrency')->name('admin.currency.get');
        Route::post('currency/delete', 'Admin\AdminController@deleteCurrency')->name('admin.currency.delete');

        Route::post('market/add', 'Admin\AdminController@addMarket')->name('admin.market.add');
        Route::post('market/update', 'Admin\AdminController@updateMarket')->name('admin.market.update');
        Route::get('market/{id}', 'Admin\AdminController@getMarket')->name('admin.market.get');
        Route::post('market/delete', 'Admin\AdminController@deleteMarket')->name('admin.market.delete');
    });
});