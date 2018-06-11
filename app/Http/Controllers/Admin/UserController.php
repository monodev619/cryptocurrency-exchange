<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 6/8/2018
 * Time: 6:27 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {
        return view('admin.user.users');
    }
}