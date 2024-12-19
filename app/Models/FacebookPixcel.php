<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookPixcel extends Model
{
    use HasFactory;
    protected $table = 'facebook_pixcel';
    protected $fillable = [
            'facebook_pixcel',
            'status',
    ];
}
