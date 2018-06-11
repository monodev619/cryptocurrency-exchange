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

        $btc_market = [];
        $eth_market = [];

        foreach ($markets as $market) {
            if ($market->market_type == 'BTC') {
                array_push($btc_market, [
                    'id' => $market->id,
                    'name' => $market->name,
                    'type' => $market->market_type,
                    'currency' => $market->currency->name
                ]);
            } elseif ($market->market_type == 'ETH') {
                array_push($eth_market, [
                    'id' => $market->id,
                    'name' => $market->name,
                    'type' => $market->market_type,
                    'currency' => $market->currency->name
                ]);
            }
        }

        return success([
            'btc' => $btc_market,
            'eth' => $eth_market
        ]);
    }
}