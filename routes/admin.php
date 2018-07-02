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

        Route::get('users', 'Admin\UserController@index')->name('admin.users');
        Route::get('getusers', 'Admin\UserController@getUsers')->name('admin.users.get');
        Route::post('user/delete', 'Admin\UserController@deleteUser')->name('admin.user.delete');

        Route::get('wallet/deposits', 'Admin\WalletController@deposits')->name('admin.wallet.deposits');
        Route::get('wallet/getDeposits', 'Admin\WalletController@getDeposits')->name('admin.wallet.getDeposits');
        Route::post('wallet/checkDeposit', 'Admin\WalletController@checkDeposit')->name('admin.wallet.checkDeposit');
        Route::get('wallet/withdrawals', 'Admin\WalletController@withdraws')->name('admin.wallet.withdraws');
        Route::get('wallet/getwithdraws', 'Admin\WalletController@getWithdraws')->name('admin.wallet.getWithdraws');
        Route::post('wallet/completeWithdrawal', 'Admin\WalletController@completeWithdraw')->name('admin.wallet.completeWithdrawal');

        Route::get('trade/orders', 'Admin\OrderController@orders')->name('admin.market.orders');
        Route::get('trade/getOrders', 'Admin\OrderController@getOrders')->name('admin.trade.getOrders');
        Route::post('trade/closeOrder', 'Admin\OrderController@closeOrder')->name('admin.trade.closeOrder');
    });
});