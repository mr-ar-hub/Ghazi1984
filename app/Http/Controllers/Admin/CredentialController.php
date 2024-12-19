<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Credentials;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    public function credential() 
    {
        $credential = Credentials::get();
        return view('admin.credential.credentials', compact('credential'));
    }
    public function editcredential($id) 
    {
        $credential = Credentials::find($id);
        return view('admin.credential.editCredential', compact('credential'));
    }
    public function updatecredential($id, Request $request) 
    {
        $data = $request->all();
        try 
        {
            $credentials = Credentials::find($id);

            if ($credentials->name == 'google' || $credentials->name == 'facebook') {
                $credentials->client_id = $data['client_id'];
                $credentials->client_secret = $data['client_secret'];
                $credentials->redirect = $data['redirect'];
            } elseif ($credentials->name == 'instagram') {
                $credentials->access_token = $data['access_token'];
                $credentials->no_ig_posts = $data['no_ig_posts'];
            }
    
            $credentials->update();

            return redirect()->back()->with('message', 'Credentials change successfully...!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The Credentials failed to change');
        }
    }
}
