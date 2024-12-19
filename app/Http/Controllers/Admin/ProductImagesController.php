<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function productImage(Request $request) 
    {
        $productimage = new ProductImages();
        
        $file = $request->file('file');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads/product-images', $filename, 'public');

        $product_type = $request->product_image_type ?? null ;
        $productimage->image_name = $path;
        $productimage->image_type = $product_type;
        $productimage->save();
    
        return response()->json([
            'status' => 200,
            'id' => $productimage->id,
            'image_name' => $path,
            'image_type' => $product_type
        ]);
    }

    public function deleteProductImage($id){
        return ProductImages::find($id)->delete();
    }
}
