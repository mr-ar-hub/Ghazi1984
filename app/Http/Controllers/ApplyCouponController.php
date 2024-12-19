<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Cart;
use Carbon\Carbon;

class ApplyCouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $code = Coupon::where('code', $request->code)->first();
        session()->put('code' , $code);
        if ($code == null) {
            return response()->json(['errormsg' => "Invalid Coupon Code"]);
        }

        // Check coupon validity
        $now = Carbon::now();
        if (!is_null($code->start_at) && $now->lt($code->start_at)) {
            return response()->json(['errormsg' => "Coupon is not yet active"]);
        }
        if (!is_null($code->end_at) && $now->gt($code->end_at)) {
            return response()->json(['errormsg' => "Coupon has expired"]);
        }
          // Check if the maximum usage limit has been reached
        $customerid = 0;
        $couponused = Order::where('coupon_id' , $code->id)->where('customerid' , $customerid)->count();
        if ($couponused >= $code->max_uses && $code->max_uses != null) {
                return response()->json(['errormsg' => "Coupon usage limit reached"]);
        }
        if($code->customer_id == 0 && $code->max_uses == null){
        $coupon = Order::where('coupon_id' , $code->id)->where('customerid' , $code->id)->count();
        if ($couponused >= '1') {
                return response()->json(['errormsg' => "Coupon is alredy used"]);
        }
        }
        if ($code->customer_id != 0 && $code->customer_id != 0) {
            return response()->json(['errormsg' => "Invalid Customer"]);
        }
        // Calculate discount
        $subtotal = 0;
        $discount = 0;
        if (Auth::check()) {
            $customerid = 0;
            $data = Cart::with('products', 'cart.product_id', '=', 'products.id')
                ->select('cart.*', 'products.price')
                ->where('cart.order_id', null)
                ->where('cart.user_id', $customerid)
                ->get();
            foreach ($data as $row) {
            $subtotal += $row->price * $row->quantity;
            }
            if ($code->min_amount > $subtotal) {
                return response()->json(['errormsg' => "Your minimum bill must be $code->min_amount $"]);
            }
            if (session()->has('code')) {
                if ($code->type == 'percentage') {
                    $discount = intval(($code->discount_amount / 100) * $subtotal);
                } else {
                    $discount = $code->discount_amount;
                }
            }
            // Store discount in session
            session()->put('discount', $discount);
        }
        
        // Return the discount as JSON response
        return response()->json([
            'discount' => $discount,
            'coupon_id' => $code->id
        ]);
    }
}
