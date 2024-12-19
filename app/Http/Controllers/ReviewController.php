<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function storeReview(Request $request)
    {
        try 
        {
            $review = new Review();

            $review->user_name = $request->input('user_name');
            $review->user_email = $request->input('user_email');
            $review->product_id = $request->input('product_id');
            $review->rating = $request->input('rating');
            $review->review = $request->input('review');
            $review->save();
            
            return back()->with('message', 'Review submitted successfully!');
        }
        catch (\Exception $e) 
        {
            return back()->with('error', 'The review failed to submitted');
        }

    }
}
