<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacebookPixcel;
use Illuminate\Http\Request;

class FacebookPixcelController extends Controller
{
    public function facebookPixcel($id)
    {
        $fbpixcel = FacebookPixcel::find($id);
        return view('admin.facebookpixcel.facebookPixcel', compact('fbpixcel'));
    }
    public function facebookPixcelUpload($id, Request $request)
    {
        $request->validate
        ([
            'facebook_pixcel' => ['required'],
        ]);
        try 
        {
            $fbpixcel = FacebookPixcel::find($id);

            $fbpixcel->facebook_pixcel = $request->facebook_pixcel;
            $fbpixcel->update();

            return back()->with('message', 'The facebook pixcel update successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The facebook pixcel failed to update');
        }
    }
}
