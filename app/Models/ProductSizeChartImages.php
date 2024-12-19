<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeChartImages extends Model
{
    use HasFactory;
    protected $table = 'product_size_chart_images';
    
    protected $fillable = [
        'name',
        'image_name'
    ];
}
