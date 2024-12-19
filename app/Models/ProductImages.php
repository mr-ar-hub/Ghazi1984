<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $fillable = [
        'image_name',
        'image_type',
        'product_uuid',
    ];
}
