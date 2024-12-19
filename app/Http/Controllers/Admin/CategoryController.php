<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function category() 
    {
        return view('admin.category.category');
    }
    public function addcategory() 
    {
        $category = Categories::get();
        return view('admin.category.addCategory', compact('category'));
    }
    public function uploadCategory(Request $request) 
    {
        $request->validate
        ([
            'cat_name' => ['required', 'unique:categories,cat_name'],
            'cat_description' => ['required'],
            'cat_image' => ['image', 'mimes:jpeg,png,jpg,svg']
        ]);
        
        $data = $request->all();
        $cat = new Categories();

        try 
        {
            $cat->cat_pid = $data['cat_pid'];
            $cat->cat_name = $data['cat_name'];
            $cat->cat_slug = Str::slug($cat->cat_name, '-');
            $cat->cat_description = $data['cat_description'];
            $cat->flag = 0;
            $cat->level = $data['cat_pid'] == 0 ? 1 : Categories::find($data['cat_pid'])->level + 1;
            $cat->order_no = Categories::where('cat_pid', $data['cat_pid'])->max('order_no') + 1;
            
            if ($data['cat_pid'] != 0) 
            {
                $parentCategory = Categories::find($data['cat_pid']);
                if ($parentCategory) 
                {
                    $parentCategory->flag += 1;
                    $parentCategory->save();
                }
            }

            if ($request->hasFile('cat_image')) {
                $file = $request->file('cat_image');
                $filename = time() .'.'. $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/category-images', $filename);
                $cat->cat_image = $path;
            }

            $cat->save();
            return redirect()->back()->with('message', 'Category added successfully!');
        }
        catch (\Exception $e) 
        {
            // dd($e->getMessage());
            return back()->with('error', 'The Category failed to add');
        }    
    }
    public function editcategory($id) 
    {
        $category = Categories::find($id);
        return view('admin.category.editCategory', compact('category'));
    }
    public function updateCategory($id, Request $request) 
    {
        $request->validate
        ([
            'cat_name' => ['required'],
            'cat_description' => ['required'],
            'cat_image' => ['image', 'mimes:jpeg,png,jpg,svg']
        ]);
        $data = $request->all();
        try 
        {
            $cat = Categories::find($id);
            $cat->cat_name = $request->cat_name;
            $cat->cat_slug = $request->cat_slug;
            $cat->cat_description = $request->cat_description;
            if ($request->hasfile('cat_image')) 
            {
                $destination = 'storage/'.$cat->cat_image;
                if (File::exists($destination)) 
                {
                    File::delete($destination);
                }
                $file = $request->file('cat_image');
                $filename = time() .'.'. $file->getClientOriginalExtension();
                $path =$request->file('cat_image')->storeAs('uploads/category-images/', $filename);
                $cat->cat_image = $path;
            }
            $cat->update();
            return redirect()->back()->with('message', 'Category Updated Successfully!');
        }
        catch (\Exception $e) 
        {
            dd($e->getMessage());
            return back()->with('error', 'The Category failed to Update');
        }
        
    }
    public function deleteCategory($id) 
    {
        $cat = Categories::find($id);
        if ($cat) 
        {
            $destination = 'storage/'.$cat->cat_image;
            if (File::exists($destination)) 
            {
                File::delete($destination);
            }
            $cat->delete();
            return back()->with('message','Category deleted successfully');
        }
        else 
        {
            return back()->with('msg','Category id not found');
        }
    }
    public function updateCategoryOrder(Request $request)
    {
        $currentOrderList = $request->input('currentOrderList');
        try 
        {
            $orderNo = 1;
            foreach($currentOrderList as $item) {
                $id = explode("-", $item)[0];
                Categories::where('id', $id)->update(['order_no' => $orderNo]);
                $orderNo++;
            }
            return response()->json(['status'=> true, 'message' => 'Category Order updated successfully']);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['status'=> false, 'message' =>'Failed to update Category Order']);
        }
    }
}
