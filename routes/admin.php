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
    });
});