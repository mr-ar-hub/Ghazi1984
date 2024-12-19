<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\Currency;

class CurrencySwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if a currency is stored in the session, else set the default currency
        if (!Session::has('currency')) {
            $defaultCurrency = Currency::where('is_default', true)->first();
            Session::put('currency', $defaultCurrency->currency_code);
        }

        // Retrieve the currency from the session and set it globally
        $currencyCode = Session::get('currency');
        $currency = Currency::where('currency_code', $currencyCode)->first();

        app()->singleton('currency', function () use ($currency) {
            return $currency;
        });

        return $next($request);
    }
}
