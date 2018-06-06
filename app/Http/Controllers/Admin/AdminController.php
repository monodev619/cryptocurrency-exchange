<?php
/**
 * Created by PhpStorm.
 * User: MONO
 * Date: 6/1/2018
 * Time: 2:32 PM
 */

namespace App\Http\Controllers\Admin;


use App\Currency;
use Illuminate\Http\Request;

class AdminController
{
    public function index(Request $request) {

        $currency = Currency::all();
        return view('admin.home')->with(['currencies' => $currency]);
    }

    public function addCurrency(Request $request) {
        validate($request->all(), [
            'logo' => 'required',
            'name' => 'required',
            'symbol' => 'required'
        ]);

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
            'logo' => $filename
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
}