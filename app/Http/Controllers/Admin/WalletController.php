<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 6/27/2018
 * Time: 8:57 AM
 */

namespace App\Http\Controllers\Admin;

use App\Deposit;
use App\Withdrawal;
use App\Http\Controllers\Controller;
use function foo\func;
use Illuminate\Http\Request;
use DB;

class WalletController extends Controller
{
    public function deposits(Request $request) {
        return view('admin.wallet.deposit');
    }

    public function getDeposits(Request $request) {

        $aColumns = array( 'users.name', 'currencies.symbol', 'deposits.address', 'deposits.amount', 'deposits.is_confirmed', 'deposits.txid', 'deposits.status', 'deposits.created_at' );

        $deposits = DB::table('deposits')
            ->leftJoin('currencies', function($join) {
                $join->on('deposits.currency_id', '=', 'currencies.id');
            })->leftJoin('users', function ($join) {
                $join->on('deposits.user_id', '=', 'users.id');
            });

        if ($request->get('name') != '') {
            $deposits = $deposits->where('users.name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->get('currency') != '') {
            $deposits = $deposits->where('currencies.symbol', 'like', '%' . $request->get('currency') . '%');
        }

        if ($request->get('address') != '') {
            $deposits = $deposits->where('deposits.address', 'like', '%' . $request->get('address') . '%');
        }

        if ($request->get('from_register_dt') != '') {
            $deposits = $deposits->whereDate('deposits.created_at', '>=', $request->get('from_register_dt'));
        }

        if ($request->get('to_register_dt') != '') {
            $deposits = $deposits->whereDate('deposits.created_at', '<=', $request->get('to_register_dt'));
        }

        if ($request->get('iSortCol_0') != '') {
            $deposits = $deposits->orderBy($aColumns[intval($request->get('iSortCol_0'))], $request->get('sSortDir_0'));
        }

        $total = $deposits->count();
        $columns = array(
            'deposits.id',
            'users.name',
            'currencies.symbol',
            'deposits.address',
            'deposits.amount',
            'deposits.is_confirmed',
            'deposits.txid',
            'deposits.status',
            'deposits.created_at'
        );

        $pageSize = intval($request->get('iDisplayLength'));
        $paginate = $deposits->select($columns)->offset(intval($request->get('iDisplayStart')))->limit(intval($request->get('iDisplayLength')))->get();

        $result = [];
        foreach ($paginate as $deposit) {
            array_push($result, [
                'id' => $deposit->id,
                'name' => $deposit->name,
                'currency' => $deposit->symbol,
                'address' => $deposit->address,
                'amount' => $deposit->amount,
                'is_confirmed' => $deposit->is_confirmed,
                'txid' => $deposit->txid,
                'status' => $deposit->status,
                'regdate' => $deposit->created_at
            ]);
        }

        return [
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $result
        ];

    }

    public function checkDeposit(Request $request) {
        validate($request->all(), [
            'id' => 'required'
        ]);
        $deposit = Deposit::find($request->get('id'));
        $deposit->update([
           'status' => 'checked'
        ]);
        return success();
    }

    public function withdraws(Request $request) {
        return view('admin.wallet.withdraw');
    }

    public function getWithdraws(Request $request) {


        $aColumns = array( 'currencies.symbol', 'withdrawals.address', 'withdrawals.quantity', 'withdrawals.total', 'withdrawals.txid', 'withdrawals.status', 'withdrawals.created_at' );

        $withdraws = DB::table('withdrawals')
            ->leftJoin('currencies', function($join) {
                $join->on('withdrawals.currency_id', '=', 'currencies.id');
            })->leftJoin('users', function ($join) {
                $join->on('withdrawals.user_id', '=', 'users.id');
            });

        if ($request->get('name') != '') {
            $withdraws = $withdraws->where('users.name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->get('currency') != '') {
            $withdraws = $withdraws->where('currencies.symbol', 'like', '%' . $request->get('currency') . '%');
        }

        if ($request->get('address') != '') {
            $withdraws = $withdraws->where('withdrawals.address', 'like', '%' . $request->get('address') . '%');
        }

        if ($request->get('from_register_dt') != '') {
            $withdraws = $withdraws->whereDate('withdrawals.created_at', '>=', $request->get('from_register_dt'));
        }

        if ($request->get('to_register_dt') != '') {
            $withdraws = $withdraws->whereDate('withdrawals.created_at', '<=', $request->get('to_register_dt'));
        }

        if ($request->get('iSortCol_0') != '') {
            $withdraws = $withdraws->orderBy($aColumns[intval($request->get('iSortCol_0'))], $request->get('sSortDir_0'));
        }

        $total = $withdraws->count();
        $columns = array(
            'withdrawals.id',
            'users.name',
            'currencies.symbol',
            'withdrawals.address',
            'withdrawals.quantity',
            'withdrawals.fee',
            'withdrawals.total',
            'withdrawals.txid',
            'withdrawals.status',
            'withdrawals.created_at'
        );

        $pageSize = intval($request->get('iDisplayLength'));
        $paginate = $withdraws->select($columns)->offset(intval($request->get('iDisplayStart')))->limit(intval($request->get('iDisplayLength')))->get();

        $result = [];
        foreach ($paginate as $withdraw) {
            array_push($result, [
                'id' => $withdraw->id,
                'name' => $withdraw->name,
                'currency' => $withdraw->symbol,
                'address' => $withdraw->address,
                'quantity' => $withdraw->quantity,
                'fee' => $withdraw->fee,
                'total' => $withdraw->total,
                'txid' => $withdraw->txid,
                'status' => $withdraw->status,
                'regdate' => $withdraw->created_at
            ]);
        }

        return [
            'sEcho' => $request->get('sEcho'),
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $result
        ];

    }

    public function completeWithdraw(Request $request) {
        validate($request->all(), [
            'id' => 'required'
        ]);
        $withdraw = Withdrawal::find($request->get('id'));
        $withdraw->update([
            'status' => 'complete'
        ]);
        return success();
    }

}