<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkSurvingImages extends Model
{
    use HasFactory;
    protected $table = 'bluk_serving_images';

    protected $fillable = [
        'image_name',
        'bluk_serving_uuid'
    ];
}
