<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupon()
    {  
        $list = Coupon::get();
        return view('admin.coupon.coupon' , compact('list')); 
    }
    public function couponform()
    {  
        $user = User::get();
        return view('admin.coupon.couponform' , compact('user'));
    }
    public function addcoupon(Request $request)
    {  
        $request->validate
        ([
            'code' => ['required', 'unique:coupons,code'],
            'name' => ['required'],
            'discountamount' => ['required', 'numeric'],
        ]);
        $data = $request->all();
        if (!empty($data['startat'] && $data['endat'])) {
            $endat = Carbon::createFromFormat('Y-m-d H:i:s', $data['endat']);
            $startat = Carbon::createFromFormat('Y-m-d H:i:s', $data['startat']);
    
            if ($endat->gt($startat) == false) {
                return redirect()->back()->with('error' , 'Start date cannot be less than or equal to the current time');
            }
            else{
                try 
                {
                    $coupon = new Coupon();
        
                    $coupon->code = $data['code'] ;
                    $coupon->name = $data['name'] ;
                    $coupon->customer_id = $data['customerid'] ;
                    $coupon->description = $data['description'] ;
                    $coupon->max_uses = isset($data['maxuses']) ? $data['maxuses'] : NULL ;
                    $coupon->type = $data['type'];
                    $coupon->discount_amount = $data['discountamount'] ;
                    $coupon->min_amount = $data['minamount'] ;
                    $coupon->start_at = $data['startat'] ;
                    $coupon->end_at = $data['endat'] ;
                    $coupon->save();
        
                    return redirect()->back()->with('message', 'Coupon Added Successfully!');
                }
                catch (\Exception $e) 
                {
                    dd($e->getMessage());
                    return back()->with('error', 'The Coupon failed to add');
                }
        
            }
        }
       
    }
}
