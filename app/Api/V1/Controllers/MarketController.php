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

    public function getMarketInfo($id) {

        $market = Market::find($id);
        print_r($market);

        if ($market->count()) {
            return success([
                'name' => $market->name,
                'type' => $market->market_type,
                'currency' => $market->currency->name,
                'symbol' => $market->currency->symbol,
                'rate' => $market->rate,
                'change' => $market->change,
                'last_price' => $market->last,
                'bid' => $market->bid,
                'ask' => $market->ask,
                'volume' => $market->volume,
                'high_24h' => $market->high_24h,
                'low_24h' => $market->low_24h,
                'minimum' => $market->minimum
            ]);
        } else {
            return error('This market is not exist', PARAMS_ILLEGAL);
        }
    }
}