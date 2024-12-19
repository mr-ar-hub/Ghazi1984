<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Instagram;
use Illuminate\Support\Facades\DB;

class InstagramController extends Controller
{
    public function index() 
    {
        $instagram = Instagram::orderBy('order_no')->get();
        return view('admin.instagram.instagram', compact('instagram'));
    }
    public function instafetchpost(Request $request)
    {
        try {
            $instaToken = DB::table('credentials')->where('name', 'instagram')->first();
    
            $endpoint = 'https://graph.instagram.com/me/media';
            $params = [
                'fields' => 'id,media_type,media_url,permalink,timestamp,children{media_type,media_url}',
                'limit' => 1000,
                'access_token' => $instaToken->access_token,
            ];
            $client = new Client();
            
            $response = $client->request('GET', $endpoint, ['query' => $params]);

            // Get response body
            $body = $response->getBody();

            // Decode JSON response
            $data = json_decode($body, true);

            // Extract media data
            $media = $data['data'] ?? [];

            // Save fetched Instagram posts to database
            Instagram::truncate();
            foreach ($media as $item) {
                // Check if the post already exists
                $existingPost = Instagram::where('instapost_id', $item['id'])->first();
                if (!$existingPost) {
                    
                    
                    $insta = new Instagram();
                    $insta->instapost_id = $item['id'];
                    $insta->postlink = $item['permalink'];
                    $insta->posttype = $item['media_type'];
                    $insta->image = $item['media_url'];
                    
                    $lastInstagram = Instagram::orderBy('order_no', 'desc')->first();
                    $orderNo = $lastInstagram ? ($lastInstagram->order_no < PHP_INT_MAX ? $lastInstagram->order_no + 1 : 1) : 1;
                    $insta->order_no = $orderNo;

                    $insta->save();
                }else {
                    $existingPost->postlink = $item['permalink'];
                    $existingPost->image = $item['media_url'];
                    $existingPost->save();
                }
            }
            return back()->with('message', 'Instagram posts fetched and saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Instagram Access Token Expire');
        }
    }
    public function instagramUpdateOrder(Request $request)
    {
        $currentOrderList = $request->input('currentOrderList');

        try {
            $orderNo = 1;
            foreach ($currentOrderList as $item) {
                $id = explode("-", $item)[0];
                Instagram::where('id', $id)->update(['order_no' => $orderNo]);
                $orderNo++;
            }
            return response()->json(['status' => true, 'message' => 'Instagram post order updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to update Instagram post order']);
        }
    }
}
