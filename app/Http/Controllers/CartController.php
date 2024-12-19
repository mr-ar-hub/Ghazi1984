<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'gender' => 'nullable|string',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'session_id' => 'nullable|string',
            'order_id' => 'nullable|integer', 
            'action' => 'required'
        ]);

        try {
            $cartItem = Cart::where('product_id', $request->input('product_id'))
                        ->where('size', $request->input('size'))
                        ->where('color', $request->input('color'))
                        ->where('session_id', $request->input('session_id'))
                        ->whereNull('order_id')
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity');
            $cartItem->save();
        } else {
            $cart = new Cart();
            $cart->size = $request->input('size');
            $cart->color = $request->input('color');
            $cart->gender = $request->input('gender');
            $cart->quantity = $request->input('quantity');
            $cart->product_id = $request->input('product_id');
            $cart->session_id = $request->input('session_id');
            $cart->action = 'add-to-cart';
            $cart->save();
        }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'gender' => 'nullable|string',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'session_id' => 'nullable|string',
            'order_id' => 'nullable|integer', 
            'action' => 'required'
        ]);

        try {
            $cartItem = Cart::where('product_id', $request->input('product_id'))
                        ->where('size', $request->input('size'))
                        ->where('color', $request->input('color'))
                        ->where('session_id', $request->input('session_id'))
                        ->whereNull('order_id')
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity');
            $cartItem->save();
        } else {
            $cart = new Cart();
            $cart->size = $request->input('size');
            $cart->color = $request->input('color');
            $cart->gender = $request->input('gender');
            $cart->quantity = $request->input('quantity');
            $cart->product_id = $request->input('product_id');
            $cart->session_id = $request->input('session_id');
            $cart->action = 'buy-now';
            $cart->save();
        }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function cart()
    {
        $sessionID = session()->getId();
        $cart = Cart::where('session_id', $sessionID)->where('action', '=', 'add-to-cart')->get();
        $cartShow = Cart::where('session_id', $sessionID)->where('order_id', null)->where('action', '=', 'add-to-cart')->first();
        $subtotal = 0;
        foreach ($cart as $item) {
            if($item->order_id == null)
            $subtotal += $item->quantity * $item->product->price;
        }

        $shippingCost = 250;
        $total = $subtotal + $shippingCost;

        return view('frontend.cart', compact('cart', 'subtotal', 'total', 'shippingCost', 'cartShow'));
    }
    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return back()->with('message', 'Cart remove succcessfully!');
    }
    public function updateCart(Request $request)
    {
        $cartItems = $request->input('cart');
    
        foreach ($cartItems as $item) {
            $cart = Cart::find($item['id']);
            if ($cart) {
                $cart->quantity = $item['quantity'];
                $cart->save();
            }
        }
    
        return response()->json(['success' => true]);
    }
    public function showCheckoutForm()
    {
        $sessionID = session()->getId();
        $cart = Cart::where('session_id', $sessionID )->get();
        $subtotal = 0;
        foreach ($cart as $item) {
            if($item->order_id == null)
            $subtotal += $item->quantity * $item->product->price;
        }
        $shippingCost = 250; 
        $total = $subtotal + $shippingCost;

        
        $cartShow = Cart::where('session_id', $sessionID)->where('action', '=', 'add-to-cart')->first();

        return view('frontend.checkout', compact('cart','subtotal','shippingCost','total', 'cartShow'));
    }
    public function removeProduct($id)
    {
        $cartItem = Cart::find($id);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }
    public function processCheckout(OrderRequest $request)
    { 
        $sessionID = session()->getId();

        $data =  $request->validated();
        try 
        {
            $order = new Order();

            $order->first_name = $data['first_name'];
            $order->last_name = $data['last_name'];
            $order->company_name = $data['company_name']; 
            $order->country = $data['country'];
            $order->street_address = $data['street_address'];
            $order->city = $data['city'];
            $order->state = $data['state'];
            $order->postal_code = $data['postal_code'];
            $order->phone = $data['phone'];
            $order->email = $data['email'];
            $order->order_note = $data['order_note']; 
            $order->order_total = $data['order_total'];
            $order->payment_method = $data['payment_method'];
            $order->status = 'pending';
            $order->comment = 'Arrived at facality';

            $order->save();

            Cart::where('session_id', $sessionID)
                ->whereNull('order_id')
                ->update(['order_id' => $order->id]);

            $orders = Order::whereHas('products', function ($query) use ($sessionID) {
                $query->where('session_id', $sessionID);
            })->with('products')
            ->get();
    
          $mailData = [
                'id' => $order->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'street_address' => $request->street_address,
                'city' => $request->city,
                'country' => $request->country,
                'order_note' => $request->order_note,
                'inquiries' => $orders,// Pass the orders to the mail data
                'created_at' => $order->created_at, 
            ];

            Mail::send('emails.orderEmail', $mailData, function ($message) use ($request) {
                $message->to('info@ghazi1984.com', 'Ghazi 1984')
                        ->to('ghaziapparel1984@gmail.com', 'Ghazi 1984')
                        ->to('ghazi1984thebrand@gmail.com', 'Ghazi 1984')
                        ->to('naveedraxa@gmail.com', 'Ghazi 1984')
                        ->subject('New Order');
            });

            return redirect()->route('orderComplete')->with('message', 'Thank you. Your order has been received!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The order failed to proceed');
        }
    }
}
