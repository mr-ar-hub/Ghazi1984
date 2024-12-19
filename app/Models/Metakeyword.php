<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metakeyword extends Model
{
    use HasFactory;

    protected $table = 'meta_keywords';
    protected $fillable = [
            'keywords',
    ];
}
