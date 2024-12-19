<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;

class DashboardController extends Controller
{
    public function dashboard() 
    {
        $maincat = Categories::where('cat_pid', 0)->count();
        $cat = Categories::where('cat_pid', '!=', 0)->count();
        $products = Products::count();
        return view('admin.dashboard', compact('maincat', 'cat', 'products'));
     }
}
