<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 5/18/2018
 * Time: 4:42 PM
 */

namespace App\Api\V1\Controllers;


use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;


class UserController extends BaseController
{

    public function me(Request $request) {
        error_log(JWTAuth::parseToken()->authenticate(), '3', '1.txt');
        return success(JWTAuth::parseToken()->authenticate());
    }
}