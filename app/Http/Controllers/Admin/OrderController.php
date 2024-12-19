<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $order = Order::with('products')->get();
        $shippingCharges = 250;

        return view('admin.order.order', compact('order', 'shippingCharges'));
    }
    public function viewOrder($id)
    {
        $order = Cart::where('order_id', $id)->first();
        $orderProduct = Cart::where('order_id', $id)->get();
        $totalPrice = 0;
        foreach ($orderProduct as $product) {
            $totalPrice += $product->quantity * $product->product->price;
        }
        
        $shippingCharges = 250;
        $totalBill = $totalPrice + $shippingCharges;

        return view('admin.order.viewOrder', compact('order','orderProduct', 'totalBill', 'shippingCharges'));
    } 
    public function orderUpdate(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->comment = $request->comment;
        $order->update();

        return back()->with('message', 'Order status change successfully!');
    }
}
