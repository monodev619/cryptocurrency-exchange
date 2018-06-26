<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 5/29/2018
 * Time: 1:54 AM
 */

namespace App\Api\V1\Controllers;

use App\Deposit;
use App\Withdrawal;
use Illuminate\Http\Request;

class WalletController extends BaseController
{
    public function createWalletAddress(Request $request) {

    }

    public function requestDeposit(Request $request) {

        validate($request->all(), [
            'user_id' => 'required',
            'currency_id' => 'required',
            'address' => 'required',
            'amount' => 'required',
            'is_confirmed' => 'required',
            'txid' => 'required'
        ]);

        $deposit = [
          'user_id' => $request->get('user_id'),
          'currency_id' => $request->get('currency_id'),
          'address' => $request->get('address'),
          'amount' => $request->get('amount'),
          'is_confirmed' => $request->get('is_confirmed'),
          'txid' => $request->get('txid')
        ];

        Deposit::create($deposit);
        return success();
    }

    public function requestWithdraw(Request $request) {

        validate($request->all(), [
            'user_id' => 'required',
            'currency_id' => 'required',
            'address' => 'required',
            'quantity' => 'required',
            'fee' => 'required',
            'total' => 'required',
            'txid' => 'required',
            'status' => 'required'
        ]);

        $withdraw = [
            'user_id' => $request->get('user_id'),
            'currency_id' => $request->get('currency_id'),
            'address' => $request->get('address'),
            'quantity' => $request->get('quantity'),
            'fee' => $request->get('fee'),
            'txid' => $request->get('txid'),
            'status' => $request->get('status'),
            'total' =>  $request->get('total')
        ];

        Withdrawal::create($withdraw);
        return success();
    }

    public function getDeposits($id) {

        $depositHistorys = Deposit::where('user_id', '=', $id)->get();
        $ret = [];
        foreach ($depositHistorys as $depositHistory) {
            array_push( $ret, [
                'id' => $depositHistory->id,
                'user' => $depositHistory->user->name,
                'name' => $depositHistory->currency->name,
                'symbol' => $depositHistory->currency->symbol,
                'address' => $depositHistory->address,
                'amount' => $depositHistory->amount,
                'is_confirmed' => $depositHistory->is_confirmed,
                'txid' => $depositHistory->txid
            ]);
        }

        return success($ret);

    }

    public function getWithdraws($id) {

        $withdrawHistorys = Withdrawal::where('user_id', '=', $id)->get();
        $ret = [];
        foreach ($withdrawHistorys as $withdrawHistory) {
            array_push( $ret, [
                'id' => $withdrawHistory->id,
                'user' => $withdrawHistory->user->name,
                'name' => $withdrawHistory->currency->name,
                'symbol' => $withdrawHistory->currency->symbol,
                'address' => $withdrawHistory->address,
                'amount' => $withdrawHistory->quantity,
                'fee' => $withdrawHistory->fee,
                'total' => $withdrawHistory->total,
                'txid' => $withdrawHistory->txid,
                'status' => $withdrawHistory->status
            ]);
        }

        return success($ret);

    }
}