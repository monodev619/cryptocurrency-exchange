<?php

use Illuminate\Http\Request;
use App\Api\V1\Controllers\AuthController;
use App\Api\V1\Controllers\UserController;
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

    $api->group( ['middleware' => 'jwt.auth' ], function ($api) {

        $api->get('user', ['as' => 'api.user', 'uses' => UserController::class . '@me']);
        $api->post('logout', ['as' => 'api.logout', 'uses' => AuthController::class . '@logout']);
    });
});