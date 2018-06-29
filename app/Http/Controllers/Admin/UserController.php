<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 6/8/2018
 * Time: 6:27 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index(Request $request) {
        return view('admin.user.users');
    }

    public function getUsers(Request $request) {
        $aColumns = array( 'users.name', 'users.email', 'user_profiles.country', 'user_profiles.state', 'users.is_active', 'users.created_at' );

        $users = DB::table('users')
            ->leftJoin('user_profiles', function($join) {
                $join->on('users.id', '=', 'user_profiles.user_id');
            });


        if ($request->get('name') != '') {
            $users = $users->where('users.name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->get('email') != '') {
            $users = $users->where('users.email', 'like', '%' . $request->get('email') . '%');
        }

//        if ($request->get('country') != '') {
//            $users = $users->where('user_profiles.country', 'like', '%' . $request->get('country') . '%');
//        }

//        if ($request->get('state') != '') {
//            $users = $users->where('user_profiles.state', 'like', '%' . $request->get('state') . '%');
//        }

        if ($request->get('from_register_dt') != '') {
            $users = $users->whereDate('users.created_at', '>=', $request->get('from_register_dt'));
        }

        if ($request->get('to_register_dt') != '') {
            $users = $users->whereDate('users.created_at', '<=', $request->get('to_register_dt'));
        }

        if ($request->get('iSortCol_0') != '') {
            $users = $users->orderBy($aColumns[intval($request->get('iSortCol_0'))], $request->get('sSortDir_0'));
        }

        $total = $users->count();
        $columns = array(
            'users.id',
            'users.name',
            'users.email',
            'user_profiles.country',
            'user_profiles.state',
            'users.is_active',
            'users.created_at'
        );
        $pageSize = intval($request->get('iDisplayLength'));
//        $paginate = $users->offset(intval($request->get('iDisplayStart')))->limit($pageSize)
//            ->get(['users.id', 'users.name', 'users.phone', 'users.avatar', 'users.region', 'auth_tokens.client_ip', 'users.created_at as register_dt', 'auth_tokens.updated_at as login_dt']);

//        $users = $users->offset(intval($request->get('iDisplayStart')))->limit(intval($request->get('iDisplayLength')))->get(['users.*']);
        $paginate = $users->select($columns)->offset(intval($request->get('iDisplayStart')))->limit(intval($request->get('iDisplayLength')))->get();

        $result = [];
        foreach ($paginate as $user) {
            array_push($result, [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'country' => $user->country,
                'state' => $user->state,
                'status' => $user->is_active,
                'regdate' => $user->created_at
            ]);
        }


        return [
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $result
        ];

    }

    public function deleteUser(Request $request) {
        validate($request->all(), [
            'id' => 'required'
        ]);

        User::destroy($request->get('id'));

        return success();
    }
}