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
        return success(JWTAuth::parseToken()->authenticate());
    }

    public function getProfile(Request $request) {

    }

    public function updateProfile(Request $request) {

    }
}