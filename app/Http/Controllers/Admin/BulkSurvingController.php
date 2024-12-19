<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\BulkSurvingImages;
use Illuminate\Http\Request;
use App\Models\BulkSurving;

class BulkSurvingController extends Controller
{
    public function indexbulkSurvingOrder()
    {
        $bulkServing = BulkSurving::get();
        return view('admin.bulk_serving.bulkServing', compact('bulkServing'));
    }
    public function addbulkSurvingOrder()
    {
        return view('admin.bulk_serving.addBulkServing');
    }
    public function bulkServingImage(Request $request) 
    {
        $bulkservingimage = new BulkSurvingImages();
        
        $file = $request->file('file');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads/bulk-serving-images', $filename, 'public');

        $bulkservingimage->image_name = $path;
        $bulkservingimage->save();
    
        return response()->json([
            'status' => 200,
            'id' => $bulkservingimage->id,
            'image_name' => $path
        ]);
    }
    public function deletebulkServingImage($id){
        return BulkSurvingImages::find($id)->delete();
    }
    public function postBulkSurvingOrder(Request $request)
    {
        $request->validate
        ([
            'name' => ['required'],
            'company_name' => ['required'],
            'bluk_serving_description' => ['required']
        ]);
        
        $data = $request->all();
        try 
        {
            $bulkServing = new BulkSurving();
            $bulkServing->name = $data['name'];
            $bulkServing->company_name = $data['company_name'];
            $bulkServing->bluk_serving_description = $data['bluk_serving_description'];

            $bulkServing->save();

            if (!empty($data['bulk_serving_images_val'])) 
            {
                $bulk_serving_images = array_merge(
                    $data['bulk_serving_images_val'],
                );
                BulkSurvingImages::whereIn('id', $bulk_serving_images)->update(['bluk_serving_uuid' => $bulkServing->id]);
            }
            return redirect()->back()->with('message', 'Bulk serving order record add successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'Bulk serving order record faild to sent!');
        }
    }
    public function deletebulkSurvingOrder($id)
    {
        $product = BulkSurving::find($id);
        $product->delete();
        
        return back()->with('message','Bulk serving order record deleted successfully');
    }
}
