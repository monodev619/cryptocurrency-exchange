<?php

use Illuminate\Http\Request;
use App\Api\V1\Controllers\AuthController;
use App\Api\V1\Controllers\UserController;
use App\Api\V1\Controllers\CurrencyController;
use App\Api\V1\Controllers\MarketController;
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
    });
});