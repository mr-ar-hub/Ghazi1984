<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'blog_id',
        'name',
        'email',
        'message',
    ];

    public function blogs(){
        return $this->belongsTo(Blogs::class, 'blog_id', 'id');
    }
}
