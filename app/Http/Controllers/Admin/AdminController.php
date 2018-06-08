<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 6/1/2018
 * Time: 2:32 PM
 */

namespace App\Http\Controllers\Admin;


use App\Currency;
use App\Market;
use Illuminate\Http\Request;

class AdminController
{
    public function index(Request $request) {

        $currencies = Currency::all();
        $markets = Market::all();
        return view('admin.home')->with([
            'currencies' => $currencies,
            'markets' => $markets
        ]);
    }

    public function addCurrency(Request $request) {
        validate($request->all(), [
            'logo' => 'required',
            'name' => 'required',
            'symbol' => 'required'
        ]);

        $currency = Currency::where('name', $request->get('name'))
            ->orWhere('symbol', $request->get('symbol'))
            ->get();

        if (!$currency->isEmpty()) {
            return error('Currency is exist already.', PARAMS_ILLEGAL);
        }

        $file = $request->hasFile('logo') ? $request->file('logo') : $request->input('logo');
        $filename = '';

        if (!is_null($file)) {
            $filename = sha1($file->getClientOriginalName() . time()) . handle_extension('png');
            save_file_as($file, config('image.image_path'), $filename);
        }

        $currency = Currency::create([
            'name' => $request->get('name'),
            'symbol' => $request->get('symbol'),
            'info' => $request->get('info'),
            'logo' => image_url($filename)
        ]);

        return success($currency);
    }

    public function updateCurrency(Request $request) {
        validate($request->all(), [
            'currency_id' => 'required',
            'name' => 'required',
            'symbol' => 'required'
        ]);

        $currency = Currency::find($request->get('currency_id'));

        $file = $request->hasFile('logo') ? $request->file('logo') : $request->input('logo');
        $filename = '';

        if (!is_null($file)) {
            $filename = sha1($file->getClientOriginalName() . time()) . handle_extension('png');
            save_file_as($file, config('image.image_path'), $filename);
            $currency->logo = $filename;
            $currency->save();
        }

        $currency->update([
            'name' => $request->get('name'),
            'symbol' => $request->get('symbol'),
            'info' => $request->get('info')
        ]);

        return success([
            'name' => $currency->name,
            'symbol' => $currency->symbol,
            'info' => $currency->info,
            'logo' => image_url($currency->logo)
        ]);
    }

    public function getCurrency($id) {
        $currency = Currency::find($id);

        return success([
            'id' => $currency->id,
            'name' => $currency->name,
            'symbol' => $currency->symbol,
            'info' => $currency->info,
            'logo' => image_url($currency->logo)
        ]);
    }

    public function deleteCurrency(Request $request) {
        validate($request->all(), [
            'id' => 'required'
        ]);

        Currency::destroy($request->get('id'));
        return success();
    }

    public function addMarket(Request $request) {
        validate($request->all(), [
            'type' => 'required',
            'currency' => 'required'
        ]);

        $currency = Currency::find($request->get('currency'));

        if ($request->get('type') == $currency->symbol) {
            return error("Type can't be equal to symbol.", PARAMS_ILLEGAL);
        }

        $marketName = $request->get('type') . "-" . $currency->symbol;
        $market = Market::where('name', $marketName)->get();
        if (!$market->isEmpty()) {
            return error("Market is exist already.", PARAMS_ILLEGAL);
        }


        $market = Market::create([
            'name' => $request->get('type') . "-" . $currency->symbol,
            'market_type' => $request->get('type'),
            'currency_id' => (int)($request->get('currency'))
        ]);

        return success([
            'id' => $market->id,
            'name' => $market->name,
            'market_type' => $market->market_type,
            'currency' => $market->currency->name,
            'minimum' => (int)$market->minimum
        ]);
    }

    public function getMarket($id) {
        $market = Market::find($id);

        return success([
            'id' => $market->id,
            'name' => $market->name,
            'market_type' => $market->market_type,
            'currency_id' => $market->currency->id,
            'minimum' => (int)$market->minimum
        ]);
    }

    public function updateMarket(Request $request) {
        validate($request->all(), [
            'market_id' => 'required',
            'type' => 'required',
            'currency' => 'required'
        ]);

        $market = Market::find($request->get('market_id'));

        $currency = Currency::find($request->get('currency'));

        if ($request->get('type') == $currency->symbol) {
            return error("Type can't be equal to symbol.", PARAMS_ILLEGAL);
        }

        $marketName = $request->get('type') . "-" . $currency->symbol;
        $marketpresent = Market::where('name', $marketName)->get();

        if (!$marketpresent->isEmpty()) {
            return error("Market is exist already.", PARAMS_ILLEGAL);
        }

        $market->update([
            'name' => $request->get('type') . "-" . $currency->symbol,
            'market_type' => $request->get('type'),
            'currency_id' =>(int)($request->get('currency'))
        ]);

        return success([
            'id' => $market->id,
            'name' => $market->name,
            'market_type' => $market->market_type,
            'currency' => $market->currency->name,
            'minimum' => (int)$market->minimum
        ]);

    }

    public function deleteMarket(Request $request) {
        validate($request->all(), [
            'id' => 'required'
        ]);

        Market::destroy($request->get('id'));
        return success();
    }
}