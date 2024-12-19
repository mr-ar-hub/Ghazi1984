<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselImages;
use Illuminate\Http\Request;

class CarouselImagesController extends Controller
{
    public function carouselImages()
    {
        $carousel = CarouselImages::orderBy('order_no')->get();  
       return view('admin.carousel.carouselImages', compact('carousel')); 
    }
    public function addNewImage()
    { 
       return view('admin.carousel.newImage'); 
    }
    public function carouselImage(Request $request) 
    {
        $carouselImage = new CarouselImages();
        
        $file = $request->file('file');
        $filename = time() .'.'. $file->getClientOriginalExtension();
        $path = $request->file('file')->storeAs('uploads/carousel-images', $filename);

        $maxOrder = CarouselImages::max('order_no');
        $carouselImage->order_no = $maxOrder ? $maxOrder + 1 : 1;

        $carouselImage->image_name = $path;
        $carouselImage->save();

        return response()->json([
            'status' => 200,
            'id' => $carouselImage->id,
            'image_name' => $path,
        ]);
    }

    public function deleteCarouselImage($id)
    {
        $img = CarouselImages::find($id);
        $img->delete();

        return back()->with('message', 'Image deleted successfully!');
    }
    public function updateCarouselImageOrder(Request $request)
    {
        $currentOrderList = $request->input('currentOrderList');
        try 
        {
            $orderNo = 1;
            foreach($currentOrderList as $item) {
                $id = explode("-", $item)[0];
                CarouselImages::where('id', $id)->update(['order_no' => $orderNo]);
                $orderNo++;
            }
            return response()->json(['status'=> true, 'message' => 'Category Order updated successfully']);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['status'=> false, 'message' =>'Failed to update Category Order']);
        }
    }
    public function updateCarouselStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $item = CarouselImages::find($id);
        if ($item) {
            $item->status = $request->input('status');
            $item->save();
            
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Item not found.'], 404);
    }
}
