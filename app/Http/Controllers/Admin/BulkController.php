<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BulkOrder;
use Illuminate\Http\Request;

class BulkController extends Controller
{
    public function indexbulkOrder() 
    {
        $bulkOrder = BulkOrder::get();
        return view('admin.bulk_order.bulkOrder', compact('bulkOrder'));
    }
    public function viewBulkOrder(Request $request, $id) 
    {
        $bulkOrder = BulkOrder::with('SampleImage')->find($id);
        $bulkOrder->status = 1;
        $bulkOrder->update();
        return view('admin.bulk_order.viewBulkOrder', compact('bulkOrder'));
    }
    public function deletebulkOrder($id) 
    {
        $inquiry = BulkOrder::find($id);
        try 
        {
            $inquiry->delete();
            return redirect()->back()->with('message', 'Bulk Order deleted successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'Bulk Order id not found');
        }
    }
}
