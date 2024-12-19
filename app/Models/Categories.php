<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'cat_pid',
        'cat_name',
        'cat_slug',
        'cat_description',
        'cat_image',
        'status',
        'flag',
    ];
    public function products()
    {
        return $this->hasMany(Products::class, 'cat_id');
    }
    public function parent()
    {
        return $this->belongsTo(Categories::class, 'cat_pid');
    }
}

