<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Categories;
use App\Models\Metakeyword;
use App\Models\Products;
use Illuminate\Http\Request;

class MetaKeywordController extends Controller
{
    public function metakeywords(){
        $data = Metakeyword::get();
        return view('admin.meta.list' , compact('data'));
    }

    public function addMetakeywords(){
        $product = Products::get();
        $blog = Blogs::get();
        $category = Categories::get();
        return view('admin.meta.create' , compact('product','blog','category'));
    }

    public function uploadMetaKeywords(Request $request){
        $request->validate([
            'keywords' => 'required|string',
        ]);

        $check = Metakeyword::where('keywords', $request->keywords)->exists();
        if($check){
            return redirect()->back()->with('error' , 'Keywords already exists');   
        }

        $metakeyword = new Metakeyword();
        $metakeyword->keywords = $request->keywords;
        $metakeyword->save();
        return redirect()->back()->with('message' , 'Keywords save successfully');

    }

    public function editMetakeywords($id){
        $data = Metakeyword::findorfail($id);
        return view('admin.meta.edit' , compact('data'));

    }

    public function updateMetakeywords(Request $request , $id){
        $request->validate([
            'keywords' => 'required|string',
        ]);
        $metakeyword = Metakeyword::findorfail($id);
        $metakeyword->keywords = $request->keywords;
        $metakeyword->save();
        return redirect()->back()->with('message' , 'Keywords update successfully');

    }

    public function deleteMetakeywords($id){
        $data = Metakeyword::findorfail($id);
        $data->delete();
        return redirect()->back()->with('message' , 'Keywords deleted successfully');

    }
}
