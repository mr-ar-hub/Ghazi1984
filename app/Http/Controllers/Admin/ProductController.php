<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Categories;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\ProductSize;
use App\Models\ProductSizeChartImages;

class ProductController extends Controller
{
    public function allProducts()
    {
        $category = Categories::all();
        $products = Products::all();
        return view('admin.products.product', compact('products', 'category'));
    }
    public function addProduct()
    {
        $size = ProductSize::get();
        $sizeChart = ProductSizeChartImages::get();
        return view('admin.products.addProduct', compact('size', 'sizeChart'));
    }
    public function addSize()
    {
        $size = ProductSize::orderBy('order_no')->get();
        return view('admin.products.addSize', compact('size'));
    }
    public function postSize(Request $request) 
    {
        $request->validate
        ([
            'name' => ['required', 'unique:product_size,name'],
        ]);
        $data = $request->all();
        try 
        {
            $size = new ProductSize();
            $size->name = $data['name'];
            $size->save();

            return back()->with('message', 'The size uload successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The size failed to add');
        }
    } 
    public function updateSizeOrder(Request $request)
    {
        $currentOrderList = $request->input('currentOrderList');

        try 
        {
            $orderNo = 1;
            foreach($currentOrderList as $id) {
                ProductSize::where('id', $id)->update(['order_no' => $orderNo]);
                $orderNo++;
            }
            return response()->json(['status'=> true, 'message' => 'Size Order updated successfully']);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['status'=> false, 'message' =>'Failed to update size order']);
        }
    }
    public function uploadProduct(ProductRequest $request) 
    {
        $data =  $request->validated();
        try 
        {
            $product = new Products();

            $product->cat_id = $data['cat_id'];
            $product->name = $data['name'];
            $product->slug = Str::slug($product->name, '-');
            $product->artical_name = $data['artical_name'];
            $product->price = $data['price'];
            $product->discount = $data['discount'];
            $product->stock = $data['stock'];
            $product->status = $data['status'];
            $product->gender = isset($request->gender) ? '1':'0';
            $product->description = $data['description'];
            $product->short_description = $data['short_description'];
            $product->size_color_map = $request->sizeColorMap;
            
            $product->save();

            if (!empty($data['product_val']) && !empty($data['carousel_images_val'])) 
            {
                $product_images = array_merge(
                    $data['product_val'],
                    $data['carousel_images_val']
                );
                ProductImages::whereIn('id', $product_images)->update(['product_uuid' => $product->id]);
            }
            return back()->with('message', 'The product uload successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The product failed to add');
        }
        
    } 
    public function editproduct($id) 
    {
        $product = Products::find($id);
        $size = ProductSize::get();
        $sizeColorMap = json_decode($product->size_color_map, true);
        $sizeChart = ProductSizeChartImages::get();
        return view('admin.products.editProduct', compact('product', 'size', 'sizeColorMap', 'sizeChart'));
    }
    public function updateProduct($id, ProductRequest $request) 
    {
        $data =  $request->validated();
        try 
        {
            $product = Products::find($id);

            $product->name = $request->name;
            $product->slug = Str::slug($product->name, '-');
            $product->artical_name = $request->artical_name;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->stock = $request->stock;
            $product->status = $request->status;
            $product->gender = isset($request->gender) ? '1':'0';
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->size_color_map = $request->sizeColorMap;
            $product->size_chart_id = $request->size_chart_id;
            

            $product->update();

            if (!empty($data['product_val']) && !empty($data['carousel_images_val'])) 
            {
                $product_images = array_merge(
                    $data['product_val'],
                    $data['carousel_images_val']
                );
                if($product_images)
                    ProductImages::whereIn('id', $product_images)->update(['product_uuid' => $id]);
            }

            return redirect()->back()->with('message', 'Product Updated Successfully!');
        }
        catch (\Exception $e) 
        {
            dd($e->getMessage());
            return back()->with('error', 'The product failed to update');
        }
        
    }
    public function deleteProduct($id) 
    {
        $product = Products::find($id);
        if ($product) 
        {
            $destination = 'storage/'.$product->image;
            if (File::exists($destination)) 
            {
                File::delete($destination);
            }
            $product->delete();
            return back()->with('message','Product deleted successfully');
        }
        else 
        {
            return back()->with('msg','Product id not found');
        }
    }

}
