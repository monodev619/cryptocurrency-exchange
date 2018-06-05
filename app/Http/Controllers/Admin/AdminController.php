<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 6/1/2018
 * Time: 2:32 PM
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class AdminController
{
    public function index(Request $request) {

        return view('admin.home');
    }
}