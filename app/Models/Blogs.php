<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'slug',
        'blog_date',
        'blog_description',
        'order_no',
        'feature',
        'status',
    ];
    public function BlogImage(){
        return $this->hasOne(BlogImages::class, 'blog_uuid', 'id');
    }
}
