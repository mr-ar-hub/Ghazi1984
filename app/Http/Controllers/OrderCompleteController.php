<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderCompleteController extends Controller
{
    public function orderComplete()
    {
        $showData = Order::where('payment_method', 'direct_bank_transfer')->first();
        $sessionID = session()->getId();
        $orders = Order::whereHas('products', function ($query) use ($sessionID) {
            $query->where('session_id', $sessionID);
        })
        ->whereNotIn('status', ['deliver', 'cancel'])
        ->with('products')
        ->get();
        $bank = BankDetails::where('status', 1)->first();
        $address = Order::first();
        return view('frontend.orderComplete', compact('showData','orders', 'bank', 'address'));
    }
}
