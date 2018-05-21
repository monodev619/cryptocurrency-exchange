<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 5/18/2018
 * Time: 12:38 PM
 */

namespace App\Api\V1\Controllers;


use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthController extends BaseController
{
    public function authenticate(Request $request) {

        validate($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return error('invalid credentials', PARAMS_ILLEGAL);
            }
        } catch (JWTException $e) {
            return error('could not create token', TOKEN_FAIL);
        }

        return success($token);
    }

    public function register(Request $request) {

        validate($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $newUser = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ];

        $user = User::create($newUser);
        $token = JWTAuth::fromUser($user);

        return success($token);
    }

    public function logout(Request $request) {
        JWTAuth::invalidate(JWTAuth::getToken());
        return success();
    }
}