<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 5/18/2018
 * Time: 4:42 PM
 */

namespace App\Api\V1\Controllers;


use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Hash;


class UserController extends BaseController
{
    public function me(Request $request) {

        $user = user();

        return success([
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name
        ]);
    }

    public function getProfile(Request $request) {

        $user = user();
        $profile = $user->userProfile;

        if (is_null($profile)) {
            return success(null);
        } else {
            return success([
                'dob' => $profile->dob,
                'country' => $profile->country,
                'street' => $profile->street,
                'apt' => $profile->apt,
                'city' => $profile->city,
                'state' => $profile->state,
                'zipcode' => $profile->zipcode,
                'phone' => $profile->phone
            ]);
        }
    }

    public function updateProfile(Request $request) {
        validate($request->all(), [
            'dob' => 'required',
            'country' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required'
        ]);

        $user = user();
        $profile = $user->userProfile;


        if (is_null($profile)) {
            $profile = UserProfile::create([
                'user_id' => $user->id,
                'dob' => $time = date('Y-m-d',strtotime($request->get('dob'))),
                'country' => $request->get('country'),
                'street' => $request->get('street'),
                'apt' => $request->get('apt'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zipcode' => $request->get('zipcode'),
                'phone' => $request->get('phone')
            ]);
        } else {
            $profile->update([
                'dob' => date('Y-m-d',strtotime($request->get('dob'))),
                'country' => $request->get('country'),
                'street' => $request->get('street'),
                'apt' => $request->get('apt'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zipcode' => $request->get('zipcode'),
                'phone' => $request->get('phone')
            ]);
        }

        return success();
    }

    public function updatePassword(Request $request) {
        validate($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = user();
        $old = $user->password;

        if (Hash::check($request->get('old_password'), $old)) {
            $user->update([
                'password' => bcrypt($request->get('password'))
            ]);

            return success();
        } else {
            return error('Password is mismatched', PASSWORD_MISMATCH);
        }
    }
}