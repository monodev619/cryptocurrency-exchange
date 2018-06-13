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

    public function getMarketInfo($name) {

        $market = Market::where('name', $name)->first();

        if ($market->count()) {
            return success([
                'id' => $market->id,
                'name' => $market->name,
                'type' => $market->market_type,
                'currency' => $market->currency->name,
                'symbol' => $market->currency->symbol,
                'logo' => image_url($market->currency->logo),
                'rate' => $market->rate,
                'change' => number_format((float)$market->change, 2, '.', ''),
                'last_price' => number_format((float)$market->last, 8, '.', ''),
                'bid' => number_format((float)$market->bid, 8, '.', ''),
                'ask' => number_format((float)$market->ask, 8, '.', ''),
                'volume' => number_format((float)$market->volume, 2, '.', ''),
                'high_24h' => number_format((float)$market->high_24h, 8, '.', ''),
                'low_24h' => number_format((float)$market->low_24h, 8, '.', ''),
                'minimum' => number_format((float)$market->minimum, 8, '.', ''),
            ]);
        } else {
            return error('This market is not exist', PARAMS_ILLEGAL);
        }
    }
}