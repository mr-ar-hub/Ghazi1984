<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLinks;
use Illuminate\Http\Request;

class SocialLinksController extends Controller
{
    public function socialLinks() 
    {
        $socaillinks = SocialLinks::get();
        return view('admin.sociallinks.socialLinks', compact('socaillinks'));
    }
    public function addNewLink() 
    {
        return view('admin.sociallinks.addNewLink');
    }
    public function uploadNewLink(Request $request) 
    {
        $request->validate
        ([
            'platform' => ['required'],
            'link' => ['required'],
            'icon' => ['required'],
            'color' => ['required'],
            'bgcolor' => ['required'],
        ]);
        
        $data = $request->all();
        try 
        {
            $link = new SocialLinks();

            $link->platform = $data['platform'];
            $link->link = $data['link'];
            $link->icon = $data['icon'];
            $link->color = $data['color'];
            $link->bgcolor = $data['bgcolor'];

        
            $link->save();

            return back()->with('message', 'The social link uload successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The social link failed to add');
        }
    }
    public function editLink($id) 
    {
        $socaillink = SocialLinks::find($id);
        return view('admin.sociallinks.editLink', compact('socaillink'));
    }
    public function updateLink($id, Request $request) 
    {
        $request->validate
        ([
            'platform' => ['required'],
            'link' => ['required'],
            'icon' => ['required'],
            'color' => ['required'],
            'bgcolor' => ['required'],
        ]);
        
        $data = $request->all();
        try 
        {
            $link = SocialLinks::find($id);

            $link->platform = $request->platform;
            $link->link = $request->link;
            $link->icon = $request->icon;
            $link->color = $request->color;
            $link->bgcolor = $request->bgcolor;
        
            $link->update();

            return back()->with('message', 'The social link update successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The social link failed to update');
        }
    }
    public function deleteLink($id) 
    {
        $link = SocialLinks::find($id);
        $link->delete();

        return back()->with('message', 'Social link delete successfully!');
    }
}
