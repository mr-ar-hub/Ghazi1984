<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function switchCurrency($currency)
    {
        // Find the currency in the database
        $currency = Currency::where('currency_code', $currency)->first();

        if ($currency) {
            Session::put('currency', $currency->currency_code);
        }

        return redirect()->back();
    }
}
