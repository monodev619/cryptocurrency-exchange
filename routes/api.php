<?php

use Illuminate\Http\Request;
use App\Api\V1\Controllers\AuthController;
use App\Api\V1\Controllers\UserController;
use App\Api\V1\Controllers\CurrencyController;
use App\Api\V1\Controllers\MarketController;
use App\Api\V1\Controllers\WalletController;
use App\Api\V1\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => ['dingo']], function ($api) {

    $api->post('login', ['as' => 'api.login', 'uses' => AuthController::class . '@authenticate']);
    $api->post('register', ['as' => 'api.register', 'uses' => AuthController::class . '@register']);
    $api->get('currencies', ['as' => 'api.currency.getall', 'uses' => CurrencyController::class . '@getCurrencies']);
    $api->get('currency/{symbol}', ['as' => 'api.currency.getinfo', 'uses' => CurrencyController::class . '@getCurrencyInfo']);
    $api->get('markets', ['as' => 'api.market.getall', 'uses' => MarketController::class . '@getMarkets']);
    $api->get('market/{name}', ['as' => 'api.market.getinfo', 'uses' => MarketController::class . '@getMarketInfo']);

    $api->group( ['middleware' => 'jwt.auth' ], function ($api) {

        $api->get('user', ['as' => 'api.user', 'uses' => UserController::class . '@me']);
        $api->post('logout', ['as' => 'api.logout', 'uses' => AuthController::class . '@logout']);
        $api->get('getProfile', ['as' => 'api.getProfile', 'uses' => UserController::class . '@getProfile']);
        $api->post('updateProfile', ['as' => 'api.updateProfile', 'uses' => UserController::class . '@updateProfile']);
        $api->post('updatePassword', ['as' => 'api.updatePassword', 'uses' => UserController::class . '@updatePassword']);
        $api->post('requestDeposit', ['as' => 'api.requestDeposit', 'uses' => WalletController::class . '@requestDeposit']);
        $api->post('requestWithdraw', ['as' => 'api.withdrawCurrency', 'uses' => WalletController::class . '@requestWithdraw']);
        $api->get('Deposits/{id}', ['as' => 'api.Deposits', 'uses' => WalletController::class . '@getDeposits']);
        $api->get('Withdraws/{id}', ['as' => 'api.Withdraws', 'uses' => WalletController::class . '@getWithdraws']);
        $api->get('PendingDeposits/{id}', ['as' => 'api.PendingDeposits', 'uses' => WalletController::class . '@getPendingDeposits']);
        $api->get('PendingWithdraws/{id}', ['as' => 'api.PendingWithdraws', 'uses' => WalletController::class . '@getPendingWithdraws']);
        $api->get('Balances/{id}', ['as' => 'api.Balances', 'uses' => WalletController::class . '@getBalances']);
        $api->post('requestBuyOrder', ['as' => 'api.requestBuyOrder', 'uses' => OrderController::class . '@requestBuyOrder']);
        $api->post('requestSellOrder', ['as' => 'api.requestSellOrder', 'uses' => OrderController::class . '@requestSellOrder']);

    });
});