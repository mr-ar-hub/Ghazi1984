<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCost;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function shipping()
    {
        $shipping = ShippingCost::get();
        return view('admin.shipping.shipping', compact('shipping'));
    }
    public function addShipping()
    {
        return view('admin.shipping.addShipping');
    }
    public function postShipping(Request $request)
    {
        $request->validate([
            'country_name' => ['required', 'unique:shipping_cost,country_name'],
            'shipping' => ['required', 'numeric'],
        ]);

        $data = $request->all();
        
        try 
        {
            $shippingCost = new ShippingCost();
            $shippingCost->country_name = $data['country_name'];
            $shippingCost->shipping = $data['shipping'];
            $shippingCost->save();

            return back()->with('message', 'The shipping cost added successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'Failed to add the shipping cost');
        }
    }
    public function editShipping($id)
    {
        $shipping = ShippingCost::find($id);
        return view('admin.shipping.editShipping', compact('shipping'));
    }
    public function update($id, Request $request)
    {
        try 
        {
            $shipping = ShippingCost::find($id);

            $shipping->country_name = $request->country_name;
            $shipping->shipping = $request->shipping;

            $shipping->updateShipping();

            return redirect()->back()->with('message', 'Shipping Cost Updated Successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The shipping cost failed to update');
        }
    }
    public function deleteShipping($id)
    {
        $shipping = ShippingCost::find($id);
        $shipping->delete();
        return back()->with('message', 'Shipping cost deleted successfully!');
    }
}
