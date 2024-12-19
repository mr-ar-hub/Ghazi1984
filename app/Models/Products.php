<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    
    protected $fillable = [
        'cat_id',
        'name',
        'slug',
        'artical_name',
        'price',
        'discount',
        'stock',
        'status',
        'gender',
        'description',
        'short_description',
        'size_color_map',
        'size_chart_id',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'cat_id');
    }
    public function catName()
    {
        return $this->belongsTo(Categories::class, 'cat_id', 'id');
    }
    public function ProductImg(){
        return $this->hasOne(ProductImages::class, 'product_uuid', 'id')->where('image_type', 'image');
    }
    public function CarouselImg(){
        return $this->hasMany(ProductImages::class, 'product_uuid', 'id')->where('image_type', 'carousel');
    }
    public function sizeChartImage()
    {
        return $this->belongsTo(ProductSizeChartImages::class, 'size_chart_id', 'id');
    }
}
