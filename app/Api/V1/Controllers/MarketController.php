<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 6/8/2018
 * Time: 3:10 PM
 */

namespace App\Api\V1\Controllers;


use App\Market;
use Illuminate\Http\Request;

class MarketController extends BaseController
{
    public function getMarkets(Request $request) {

        $markets = Market::all();

        $ret = [];
        foreach ($markets as $market) {
            array_push($ret, [
                'id' => $market->id,
                'name' => $market->name,
                'type' => $market->market_type,
                'currency' => $market->currency->symbol
            ]);
        }

        return success($ret);
    }
}