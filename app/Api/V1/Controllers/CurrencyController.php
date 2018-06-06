<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 6/5/2018
 * Time: 4:46 PM
 */

namespace App\Api\V1\Controllers;


use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends BaseController
{
    public function getCurrencies(Request $request) {

        $currencies = Currency::all();

        $ret = [];
        foreach ($currencies as $currency) {
            array_push($ret, [
                'id' => $currency->id,
                'name' => $currency->name,
                'symbol' => $currency->symbol,
                'info' => $currency->info,
                'logo' => $currency->logo
            ]);
        }
        return success($ret);
    }
}