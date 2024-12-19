<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkOrderRequest;
use Illuminate\Http\Request;
use App\Models\BulkOrder;
use App\Models\Blogs;
use App\Models\BulkSurving;
use App\Models\SampleImages;
use Illuminate\Support\Facades\Mail;

class BulkOrderController extends Controller
{
    public function bulkOrder()
    {
        $bulkServing = BulkSurving::where('status', 1)->get();
        return view('frontend.bulkOrder', compact('bulkServing'));
    }
    public function bulkOrderPost(BulkOrderRequest $request)
    {
        $data =  $request->validated();
        try 
        {
            $bulk = new BulkOrder();
            $bulk->name = $data['name'];
            $bulk->email = $data['email'];
            $bulk->company_name = $data['company_name'];
            $bulk->phone = $data['phone'];
            $bulk->address = $data['address'];
            $bulk->country = $data['country'];
            
            $bulk->requirement = $data['requirement'];
            $bulk->quantity = $data['quantity'];

            $bulk->save();

            if (!empty($data['bulk_sample_val'])) 
            {
                $sample_images = array_merge(
                    $data['bulk_sample_val'],
                );
                SampleImages::whereIn('id', $sample_images)->update(['bluk_uuid' => $bulk->id]);
            }
            $bulkOrders = BulkOrder::with('SampleImage')->find($bulk->id);
    
            $mailData = [
                'name' => $request->name,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
                'requirement' => $request->requirement,
                'quantity' => $request->quantity,
                'inquiries' => $bulkOrders,
            ];
            Mail::send('emails.bulkOrderEmail', $mailData, function ($message) use ($request) {
                $message->to('info@ghazi1984.com', 'Ghazi 1984')
                        ->to('ghaziapparel1984@gmail.com', 'Ghazi 1984')
                        ->to('ghazi1984thebrand@gmail.com', 'Ghazi 1984')
                        ->to('naveedraxa@gmail.com', 'Ghazi 1984')
                        ->subject('Bulk Order');
            });

            return redirect()->back()->with('message', 'Bulk order sent successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'Bulk order faild to sent!');
        }
    }
    public function sampleImage(Request $request) 
    {
        $sample_images = new SampleImages();
        
        $file = $request->file('file');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads/bulk-order', $filename, 'public');

        $sample_images->image_name = $path;
        $sample_images->save();
    
        return response()->json([
            'status' => 200,
            'id' => $sample_images->id,
            'image_name' => $path
        ]);
    }
    public function deleteSampleImage($id){
        return SampleImages::find($id)->delete();
    }
}
