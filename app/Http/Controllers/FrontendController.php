<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\CarouselImages;
use App\Models\Cart;
use App\Models\Categories;
use App\Models\Instagram;
use App\Models\Products;
use App\Models\ProductSize;
use App\Models\Spotted;
use App\Models\Review;
use App\Models\Comment;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $category = Categories::withCount('products')->where('cat_pid', '!=', 0)->orderBy('order_no')->get();
        $products = Products::inRandomOrder()->get();
        $newproducts = Products::inRandomOrder()->where('status', 0)->get();
        $carousel = CarouselImages::orderBy('order_no')->where('status', 1)->get();
        $spotted = Spotted::orderBy('order_no')->where('status', 1)->get();
        $blog = Blogs::orderBy('order_no')->where('feature', 1)->where('status', 1)->get();
        $instaimg = Instagram::orderBy('order_no')->where('status', 1)->where('posttype', ['IMAGE', 'CAROUSEL_ALBUM'])->take(20)->get();
        return view('index', compact('category', 'products', 'newproducts', 'carousel', 'spotted', 'blog', 'instaimg'));
    }
    public function shop()
    {
        $pagination = Products::paginate(10);
        $products = Products::limit(10)->inRandomOrder()->get();
        $sideproducts = Products::limit(5)->inRandomOrder()->get();
        $maxPriceFromDb = Products::max('price');
        return view('frontend.shop', compact('products', 'sideproducts', 'pagination', 'maxPriceFromDb'));
    }
    public function aboutUs()
    {
        return view('frontend.aboutUs');
    }
    public function contactUs()
    {
        return view('frontend.contactUs');
    }
    public function privacyPolicy()
    {
        return view('frontend.privacyPolicy');
    }
    public function categories($id)
    {
        $category = Categories::with('parent')->withCount('products')->where('cat_pid', $id)->get();
        $sideproducts = Products::limit(5)->inRandomOrder()->get();
        $categories = Categories::where('cat_pid', '!=', 0)->withCount('products')->get();
        $count = Products::count();
        $maxPriceFromDb = Products::max('price');
        return view('frontend.categories', compact('category', 'sideproducts', 'categories', 'count', 'maxPriceFromDb'));
    }
    public function products($id)
    {
        $products = Products::where('cat_id', $id)->paginate(10);
        $sideproducts = Products::limit(5)->inRandomOrder()->get();
        $categories = Categories::with('parent')->withCount('products')->where('cat_pid', '!=', 0)->get();
        $count = Products::count();
        $maxPriceFromDb = Products::max('price');
        return view('frontend.products', compact('products', 'sideproducts', 'categories', 'count', 'maxPriceFromDb'));
    }
    public function filterByPrice(Request $request)
    {
        $request->validate([
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|min:0|gte:min_price',
        ]);
    
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
    
        $products = Products::whereBetween('price', [$minPrice, $maxPrice])->paginate(10);
    
        $sideproducts = Products::limit(5)->inRandomOrder()->get();
        $categories = Categories::with('parent')->withCount('products')->where('cat_pid', '!=', 0)->get();
        $count = Products::count();

        $maxPriceFromDb = Products::max('price');
    
        return view('frontend.products', compact('products', 'sideproducts', 'categories', 'count', 'maxPriceFromDb'));
    }
    public function productDetail($id)
    {
        $product = Products::find($id);
        if (!$product) 
        {
            return redirect()->route('index');
        }
        $products = Products::where('cat_id', $product->cat_id)->get();
        $sizeColorMap = json_decode($product->size_color_map, true);
        if (is_array($sizeColorMap)) {
            $sizeNames = array_keys($sizeColorMap);
        } else {
            $sizeNames = [];
        }
        $sizes = ProductSize::whereIn('name', $sizeNames)->get();
        $totalreview = Review::where('product_id', $id)->count();
        $reviews = Review::where('product_id', $product->id)->get();

        $sessionID = session()->getId();
        $cart = Cart::where('session_id', $sessionID)->where('action', '=', 'add-to-cart')->where('order_id', null)->get();
        $subtotal = 0;
        foreach ($cart as $item) {
            if($item->order_id == null)
            $subtotal += $item->quantity * $item->product->price;
        }
        $total = $subtotal;

        return view('frontend.productDetail', compact('product','sizes','products', 'sizeColorMap', 'totalreview', 'reviews','cart', 'subtotal', 'total'));
    }
    public function removeFromCart(Request $request)
    {
        $item = Cart::find($request->item_id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    public function lostPassword()
    {
        return view('frontend.lostPassword');
    }
    public function wishlist()  
    {
        return view('frontend.wishlist');
    }
    public function blog()
    {
        $blogs = Blogs::where('feature', 1)->where('status', 1)->get();
        return view('frontend.blog', compact('blogs'));
    }
       public function blogDetail($slug)
    {
        $blog = Blogs::where('slug', $slug)->first();
        $recentBlogs = Blogs::inRandomOrder()->limit(3)->where('feature', 1)->where('status', 1)->get();

        $previousBlog = Blogs::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        $nextBlog = Blogs::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();

        $comments = Comment::where('blog_id' , $blog->id)->get();

        return view('frontend.blogDetail', compact('blog', 'recentBlogs', 'previousBlog', 'nextBlog' , 'comments'));
    }
    public function account()
    {
        return view('frontend.account');
    }
    public function search(Request $request)
    {
        $query = $request->input('search');

        $sideproducts = Products::limit(5)->inRandomOrder()->get();
        $categories = Categories::with('parent')->withCount('products')->where('cat_pid', '!=', 0)->get();
        $count = Products::count();
        $maxPriceFromDb = Products::max('price');

        $products = Products::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('slug', 'LIKE', '%' . $query . '%')
                ->orWhere('artical_name', 'LIKE', '%' . $query . '%')
                ->orWhere('price', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')
                ->orWhere('short_description', 'LIKE', '%' . $query . '%');
        })
            ->paginate(9);
        
        return view('frontend.search', compact('sideproducts','categories', 'count', 'maxPriceFromDb', 'products'));
    } 
      public function upload(Request $request)
    {
        // Validate the request data
        $request->validate([
            'message' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $comment = new Comment();
        $comment->blog_id = $request->input('blog_id');
        $comment->message = $request->input('message');
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->save();

        // Redirect back with a success message or return a response
        return redirect()->back()->with('success', 'Comment posted successfully!');
    }
}
