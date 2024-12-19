<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSizeChartImages;
use Illuminate\Http\Request;

class ProductSizeChartController extends Controller
{
    public function productSizeChart()
    {
        $sizeCharts = ProductSizeChartImages::get();
        return view('admin.products.productsizechart.sizeCharts', compact('sizeCharts'));
    }
    public function addProductSizeChart()
    {
        return view('admin.products.productsizechart.addSizeChart');
    }
    public function productSizeChartImage(Request $request) 
    {
        $productimage = new ProductSizeChartImages();
        
        $file = $request->file('file');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads/product-size-chart-images', $filename, 'public');
        $productimage->image_name = $path;
        $productimage->save();
    
        session(['uploaded_image_name' => $path]);

        return response()->json([
            'status' => 200,
            'id' => $productimage->id,
            'image_name' => $path,
        ]);
    } 
    public function uploadProductSizeChart(Request $request)
    {
        $image_name = session('uploaded_image_name');
        // Check if image_name exists
        if (!$image_name) {
            return back()->withErrors(['message' => 'Image not found in session. Please try uploading the image again.']);
        }

        $sizechart = ProductSizeChartImages::where('image_name', $image_name)->first();

        // Check if the sizechart exists
        if (!$sizechart) {
            return back()->withErrors(['message' => 'Image not found in the database. Please try again.']);
        }

        $sizechart->name = $request->name;
        $sizechart->save(); // Use save() instead of update()

        return back()->with('message', 'Successfully updated size chart!');
    }
    public function deleteSizeChartImage($id)
    {
        $img = ProductSizeChartImages::find($id);
        $img->delete();

        return back()->with('message', 'Image deleted successfully!');
    }
    public function deleteSizeChart($id)
    {
        $img = ProductSizeChartImages::find($id);
        $img->delete();

        return back()->with('message', 'Size chart deleted successfully!');
    }
}
