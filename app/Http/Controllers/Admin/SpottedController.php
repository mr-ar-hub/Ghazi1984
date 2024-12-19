<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spotted;
use App\Models\SpottedImages;
use Illuminate\Http\Request;

class SpottedController extends Controller
{
    public function spottedGhazi()
    {
        $spotted = Spotted::orderBy('order_no')->get();
        return view('admin.spottedGhazi.spotted', compact('spotted'));
    }
    public function updateSpottedImageOrder(Request $request)
    {
        $currentOrderList = $request->input('currentOrderList');
        try 
        {
            $orderNo = 1;
            foreach($currentOrderList as $item) {
                $id = explode("-", $item)[0];
                Spotted::where('id', $id)->update(['order_no' => $orderNo]);
                $orderNo++;
            }
            return response()->json(['status'=> true, 'message' => 'Category Order updated successfully']);
        } 
        catch (\Exception $e) 
        {
            return response()->json(['status'=> false, 'message' =>'Failed to update Category Order']);
        }
    }
    public function updateSpottedStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $item = Spotted::find($id);
        if ($item) {
            $item->status = $request->input('status');
            $item->save();
            
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Item not found.'], 404);
    }
    public function deleteSpotted($id)
    {
        $img = Spotted::find($id);
        $img->delete();

        return back()->with('message', 'Image deleted successfully!');
    }
    public function addNewSpotted()
    {
        return view('admin.spottedGhazi.addSpotted');
    }
    public function spottedImage(Request $request) 
    {
        $spotted = new SpottedImages();

        $file = $request->file('file');
        $filename = time() .'.'. $file->getClientOriginalExtension();
        $path =$request->file('file')->storeAs('uploads/spotted-images', $filename);

        $spotted->image_name = $path;
        $spotted->save();
    
        return response()->json([
            'status' => 200,
            'id' => $spotted->id,
            'image_name' => $path,
        ]);
    }
    public function deleteSpottedImage($id)
    {
        $img = SpottedImages::find($id);
        $img->delete();

        return back()->with('message', 'Image deleted successfully!');
    }
    public function uploadSpotted(Request $request)
    {   
        $request->validate
        ([
            'name' => ['required'],
        ]);
        
        $data = $request->all();
        try 
        {
            $spotted = new Spotted();

            $spotted->name = $data['name'];
            
            $maxOrder = Spotted::max('order_no');
            $spotted->order_no = $maxOrder ? $maxOrder + 1 : 1;
            
            $spotted->save();

            if (!empty($data['spotted_images_val'])) 
            {
                $spotted_images = array_merge(
                    $data['spotted_images_val']
                );
                SpottedImages::whereIn('id', $spotted_images)->update(['spotted_uuid' => $spotted->id]);
            }
            return back()->with('message', 'The spotted uload successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The spotted failed to add');
        }
    }
    public function editSpotted($id)
    {
        $spotted = Spotted::find($id);
        return view('admin.spottedGhazi.editSpotted', compact('spotted'));
    }
    public function updateSpotted($id, Request $request)
    {   
        $data = $request->all();
        try 
        {
            $spotted = Spotted::find($id);

            if (!$spotted) {
                return back()->with('error', 'Spotted item not found.');
            }

            $spotted->name = $request->name;
            $spotted->update();

            if (!empty($data['spotted_images_val'])) 
            {
                $spotted_images = array_merge($data['spotted_images_val']);
                if($spotted_images)
                    SpottedImages::whereIn('id', $spotted_images)->update(['spotted_uuid' => $id]);
            }

            return back()->with('message', 'The spotted upload successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The spotted failed to update.');
        }
    }
}
