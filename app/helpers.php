<?php

if (! function_exists('format_price')) {
    function format_price($amount)
    {
        // Get the currency from the app's container
        $currency = app('currency');

        // Convert the amount based on the currency's exchange rate
        $convertedAmount = $amount * $currency->currency_rate;

        // Format and return the amount with the currency symbol
        return $currency->symbol . ' ' . number_format($convertedAmount, 2);
    }
}

if (! function_exists('format_price_only')) {
    function format_price_only($amount)
    {
        // Get the currency from the app's container
        $currency = app('currency');

        // Convert the amount based on the currency's exchange rate
        $convertedAmount = $amount * $currency->currency_rate;

        // Return the raw converted amount without rounding
        return $convertedAmount;
    }
}

if (! function_exists('get_currency_symbol')) {
    function get_currency_symbol()
    {
        // Get the currency from the app's container
        $currency = app('currency');

        return $currency->symbol;
    }
}
