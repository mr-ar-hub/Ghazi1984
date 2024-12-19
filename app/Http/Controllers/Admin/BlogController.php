<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BlogImages;
use App\Models\Blogs;
use App\Models\Comment;

class BlogController extends Controller
{
    public function blogs()
    {
        $blog = Blogs::orderBy('order_no')->get();
        return view('admin.blogs.blog', compact('blog'));
    }
    public function updateBlogImageOrder(Request $request)
    {
        $currentOrderList = $request->input('currentOrderList');
        try 
        {
            $orderNo = 1;
            foreach($currentOrderList as $item) {
                $id = explode("-", $item)[0];
                Blogs::where('id', $id)->update(['order_no' => $orderNo]);
                $orderNo++;
            }
            return response()->json(['status'=> true, 'message' => 'Category Order updated successfully']);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['status'=> false, 'message' =>'Failed to update Category Order']);
        }
    }
    public function updateBlogStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $item = Blogs::find($id);
        if ($item) {
            $item->status = $request->input('status');
            $item->save();
            
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Item not found.'], 404);
    }
    public function deleteBlog($id)
    {
        $img = Blogs::find($id);
        $img->delete();

        return back()->with('message', 'Blog deleted successfully!');
    }
    public function addNewBlog()
    {
        return view('admin.blogs.addBlog');
    }
    public function blogImage(Request $request) 
    {
        $blog = new BlogImages();

        $file = $request->file('file');
        $filename = time() .'.'. $file->getClientOriginalExtension();
        $path =$request->file('file')->storeAs('uploads/blog-images', $filename);

        $blog->image_name = $path;
        $blog->save();
    
        return response()->json([
            'status' => 200,
            'id' => $blog->id,
            'image_name' => $path,
        ]);
    }
    public function deleteBlogImage($id)
    {
        $img = BlogImages::find($id);
        $img->delete();

        return back()->with('message', 'Image deleted successfully!');
    }
    public function uploadBlog(Request $request)
    {
        $request->validate
        ([
            'title' => ['required'],
            'auther_name' => ['required'],
            'blog_date' => ['required'],
            'short_description' => ['required'],
            'blog_description' => ['required'],
            'blog_images_val' => ['required'],
        ]);
        
        $data = $request->all();
        try 
        {
            $blog = new Blogs();

            $blog->title = $data['title'];
            $blog->auther_name = $data['auther_name'];
            $blog->slug = Str::slug($blog->title, '-');
            $blog->blog_date = $data['blog_date'];
            $blog->short_description = $data['short_description'];
            $blog->blog_description = $data['blog_description'];
            
            $maxOrder = Blogs::max('order_no');
            $blog->order_no = $maxOrder ? $maxOrder + 1 : 1;

            $blog->feature = isset($request->feature) ? '1':'0';
            
            $blog->save();

            if (!empty($data['blog_images_val'])) 
            {
                $blog_images = array_merge(
                    $data['blog_images_val']
                );
                BlogImages::whereIn('id', $blog_images)->update(['blog_uuid' => $blog->id]);
            }
            return back()->with('message', 'The blog uload successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The blog failed to add');
        }
    }
    public function editBlog($id)
    {
        $blog = Blogs::find($id);
        return view('admin.blogs.editBlog', compact('blog'));
    }
    public function updateBlog($id, Request $request)
    {
        $data = $request->all();
        try 
        {
            $blog = Blogs::find($id);

            if (!$blog) {
                return back()->with('error', 'Blog item not found.');
            }

            $blog->title = $request->title;
            $blog->auther_name = $request->auther_name;
            $blog->blog_date = $request->blog_date;
            $blog->short_description = $request->short_description;
            $blog->blog_description = $request->blog_description;
            
            $blog->feature = isset($request->feature) ? '1':'0';
            $blog->update();

            if (!empty($data['blog_images_val'])) 
            {
                $blog_images = array_merge($data['blog_images_val']);
                if($blog_images)
                BlogImages::whereIn('id', $blog_images)->update(['blog_uuid' => $id]);
            }

            return back()->with('message', 'The blog update successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The blog failed to update.');
        }
    }
        public function blogComment($id){
        $data = Comment::where('blog_id' , $id)->get();
        return view('admin.blogs.blogComments' , compact('data'));
    }
}
