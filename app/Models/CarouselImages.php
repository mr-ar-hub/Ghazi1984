<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselImages extends Model
{
    use HasFactory;
    protected $table = 'carousel_images';
    protected $fillable = [
        'image_name',
        'order_no',
        'status',
    ];
}
