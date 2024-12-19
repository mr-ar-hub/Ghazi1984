<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{
    public function authenticate(Request $request) 
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) 
        {
            return redirect()->intended('admin/')->with('message', 'You are Successfully Logged in!');
        } 
        else 
        {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }
    public function adminlogout() 
    {
        Auth::guard('admin')->logout();
        return redirect()->intended('admin/admin-login')->with('message', 'Youre are successfully Logout!');
    }
}
