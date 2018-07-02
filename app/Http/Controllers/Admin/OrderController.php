<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 7/2/2018
 * Time: 12:04 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function orders(Request $request) {
        return view('admin.market.order');
    }

    public function getOrders(Request $request) {

        $aColumns = array( 'users.name', 'markets.name', 'orders.bidask', 'orders.order_type', 'orders.quantity', 'orders.price', 'orders.condition', 'orders.target_price', 'orders.fee', 'orders.total', 'orders.timeinforce', 'orders.balance', 'orders.status', 'orders.created_at', 'orders.updated_at' );

        $orders = DB::table('orders')
            ->leftJoin('markets', function($join) {
                $join->on('orders.market_id', '=', 'markets.id');
            })->leftJoin('users', function ($join) {
                $join->on('orders.user_id', '=', 'users.id');
            });

        if ($request->get('name') != '') {
            $orders = $orders->where('users.name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->get('market') != '') {
            $orders = $orders->where('markets.name', 'like', '%' . $request->get('market') . '%');
        }

        if ($request->get('bidask') != '') {
            $orders = $orders->where('orders.bidask', 'like', '%' . $request->get('bidask') . '%');
        }

        if ($request->get('ordertype') != '') {
            $orders = $orders->where('orders.order_type', 'like', '%' . $request->get('ordertype') . '%');
        }

        if ($request->get('condition') != '') {
            $orders = $orders->where('orders.condition', 'like', '%' . $request->get('condition') . '%');
        }

        if ($request->get('from_register_dt') != '') {
            $orders = $orders->whereDate('orders.created_at', '>=', $request->get('from_register_dt'));
        }

        if ($request->get('to_register_dt') != '') {
            $orders = $orders->whereDate('orders.created_at', '<=', $request->get('to_register_dt'));
        }

        if ($request->get('iSortCol_0') != '') {
            $orders = $orders->orderBy($aColumns[intval($request->get('iSortCol_0'))], $request->get('sSortDir_0'));
        }

        $total = $orders->count();
        $columns = array(
            'orders.id',
            'users.name as userName',
            'markets.name as marketName',
            'orders.bidask',
            'orders.order_type',
            'orders.quantity',
            'orders.price',
            'orders.condition',
            'orders.target_price',
            'orders.fee',
            'orders.total',
            'orders.timeinforce',
            'orders.balance',
            'orders.status',
            'orders.created_at',
            'orders.updated_at',
        );

        $pageSize = intval($request->get('iDisplayLength'));
        $paginate = $orders->select($columns)->offset(intval($request->get('iDisplayStart')))->limit(intval($request->get('iDisplayLength')))->get();

        $result = [];
        foreach ($paginate as $order) {
            array_push($result, [
                'id' => $order->id,
                'userName' => $order->userName,
                'marketName' => $order->marketName,
                'bidask' => $order->bidask,
                'order_type' => $order->order_type,
                'quantity' => $order->quantity,
                'price' => $order->price,
                'condition' => $order->condition,
                'target_price' => $order->target_price,
                'fee' => $order->fee,
                'total' => $order->total,
                'timeinforce' => $order->timeinforce,
                'balance' => $order->balance,
                'status' => $order->status,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at
            ]);
        }

        return [
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $result
        ];

    }

    public function closeOrder(Request $request) {
        validate($request->all(), [
            'id' => 'required'
        ]);
        $order = Order::find($request->get('id'));
        $order->update([
            'status' => 'closed'
        ]);
        return success();
    }


}