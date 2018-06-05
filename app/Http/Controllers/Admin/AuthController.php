<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 5/30/2018
 * Time: 9:50 AM
 */

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_view(Request $request) {
        return view('admin.login');
    }

    public function register(Request $request) {
        validate($request->all(), [
            'name' => 'required',
            'password' => 'required|confirmed'
        ]);

        $cred = [
            'name' => $request->get('name'),
            'password' => bcrypt($request->get('password'))
        ];

        $admin = Admin::create($cred);

        return success();
    }

    public function login(Request $request) {
        validate($request->all(), [
            'name' => 'required',
            'password' => 'required'
        ]);

        $cred = [
            'name' => $request->get('name'),
            'password' => $request->get('password')
        ];

        if (auth()->guard('admin')->attempt($cred)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login_view');
        }
    }

    public function logout(Request $request) {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login_view');
    }
}