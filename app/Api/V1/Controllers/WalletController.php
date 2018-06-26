<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 5/29/2018
 * Time: 1:54 AM
 */

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

class WalletController extends BaseController
{
    public function createWalletAddress(Request $request) {

    }

    public function createDeposit(Request $request) {

    }

    public function getDeposits(Request $request) {
        $user = user();
    }

    public function requestWithdraw(Request $request) {

    }

    public function getWithdrwals(Request $request) {

    }
}