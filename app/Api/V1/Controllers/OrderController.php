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
    public function requestBuyOrder(Request $request) {

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
            $res
        ]);
    }

    public function getOrders($id) {
        $orderHistorys = Order::where('user_id', '=', $id)->get();
        $ret = [];
        foreach ($orderHistorys as $orderHistory) {
            array_push( $ret, [
                'id' => $orderHistory->id,
                'user' => $orderHistory->user->name,
                'name' => $orderHistory->currency->name,
                'symbol' => $orderHistory->currency->symbol,
                'address' => $orderHistory->address,
                'amount' => $orderHistory->amount,
                'is_confirmed' => $orderHistory->is_confirmed,
                'txid' => $orderHistory->txid,
                'date' => $orderHistory->created_at,
                'status' => $orderHistory->status
            ]);
        }
        return success($ret);
    }



}