<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 6/29/2018
 * Time: 2:24 AM
 */

namespace App\Api\V1\Controllers;

use App\Order;
use Illuminate\Http\Request;
class OrderController extends BaseController
{
    public function requestOrder(Request $request) {

        validate($request->all(), [
            'user_id' => 'required',
            'market_id' => 'required',
            'bidask' => 'required',
            'order_type' => 'required',
            'quantity' => 'required',
            'price' => 'required',
//            'condition' => 'required',
//            'target_price' => 'required',
            'fee' => 'required',
            'total' => 'required',
            'timeinforce' => 'required',
            'balance' => 'required',
            'status' => 'required'
        ]);

        $order = [
            'user_id' => $request->get('user_id'),
            'market_id' => $request->get('market_id'),
            'bidask' => $request->get('bidask'),
            'order_type' => $request->get('order_type'),
            'quantity' => $request->get('quantity'),
            'price' => $request->get('price'),
            'condition' => $request->get('condition'),
            'target_price' => $request->get('target_price'),
            'fee' => $request->get('fee'),
            'total' => $request->get('total'),
            'timeinforce' => $request->get('timeinforce'),
            'balance' => $request->get('balance'),
            'status' => $request->get('status')
        ];

        $res = Order::create($order);
//        ($res->status == 1)? $status = 'checked' : (($res->status == 2) ? $status = 'unchecked' : 'none');
        return success([
            'user_id' => $res->user_id,
            'market_id' => $res->market_id,
            'bidask' => $res->bidask,
            'order_type' => $res->order_type,
            'quantity' => $res->quantity,
            'price' => $res->price,
            'condition' => $res->condition,
            'target_price' => $res->target_price,
            'fee' => $res->fee,
            'total' => $res->total,
            'timeforce' => $res->timeforce,
            'balance' => $res->balance,
            'status' => $res->status,
            'created_at' => $res->created_at,
            'updated_at' => $res->updated_at
        ]);
    }

    public function getOrders(Request $request) {
        $user_id = $request->get('user_id');
        $market_id = $request->get('market_id');

        $openOrders = Order::where([['user_id', '=', $user_id], ['market_id', '=', $market_id]])->get();
        $ret = [];
        foreach ($openOrders as $openOrder) {
            array_push( $ret, [
                'id' => $openOrder->id,
                'type' => $openOrder->order_type,
                'bid/ask' => $openOrder->bidask,
                'total_units' => $openOrder->total,
                'open_date' => $openOrder->created_at,
                'close_date' => $openOrder->updated_at
            ]);
        }
        return success($ret);
    }


    public function getOpenOrders(Request $request) {
        $user_id = $request->get('user_id');
        $market_id = $request->get('market_id');
        $openOrders = Order::where([['user_id', '=', $user_id], ['status', '=', 'opened'], ['market_id', '=', $market_id]])->get();
        $ret = [];
        foreach ($openOrders as $openOrder) {
            array_push( $ret, [
                'id' => $openOrder->id,
                'type' => $openOrder->order_type,
                'bidask' => $openOrder->bidask,
                'units_total' => $openOrder->total,
                'order_date' => $openOrder->created_at

            ]);
        }
        return success($ret);
    }

}