<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyExchangeController extends Controller
{
    public function currency(){
        $currency = Currency::get();
        return view('admin.currency.list' , compact('currency'));
    }

    public function addCurrency(){
        return view('admin.currency.create');
    }

    public function uploadCurrency(Request $request){
        $request->validate([
            'title' => 'required|string|unique:currencies,title',
            'code' => 'required|string|unique:currencies,currency_code',
            'symbol' => 'required|string|unique:currencies,symbol',
            'rate' => 'required|numeric',
        ]);

        $currency = new Currency();
        $currency->title = $request->title;
        $currency->currency_code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->currency_rate = $request->rate;
        $currency->position = $request->position;
        $currency->save();

        return redirect()->back()->with('message', 'Currency Rate save successfully...!');

    }

    public function deleteCurrency($id){
        $data = Currency::find($id);
        $data->delete();

        return back()->with('message', 'Currency deleted successfully!');
    }

    public function editCurrency($id){
        $data = Currency::find($id);

        return view('admin.currency.update' , compact('data'));
    }

    public function updateCurrency(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|unique:currencies,title,' . $id,
        'code' => 'required|string|unique:currencies,currency_code,' . $id,
        'symbol' => 'required|string|unique:currencies,symbol,' . $id,
        'rate' => 'required|numeric',
    ]);

    $currency = Currency::find($id);

    // Check if the currency exists
    if (!$currency) {
        return redirect()->back()->with('error', 'Currency not found.');
    }

    // Update the currency attributes
    $currency->title = $request->title;
    $currency->currency_code = $request->code;
    $currency->symbol = $request->symbol;
    $currency->currency_rate = $request->rate;
    $currency->position = $request->position;
    $currency->save();

    return redirect()->route('currency')->with('message', 'Currency Rate updated successfully...!');
}


}
