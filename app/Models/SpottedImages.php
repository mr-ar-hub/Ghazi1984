<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpottedImages extends Model
{
    use HasFactory;
    protected $table = 'spotted_images';
    
    protected $fillable = [
        'image_name',
        'spotted_uuid',
    ];
}
