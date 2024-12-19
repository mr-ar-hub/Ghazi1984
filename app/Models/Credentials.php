<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credentials extends Model
{
    use HasFactory;
    protected $table = 'credentials';

    protected $fillable = [
        'name',
        'client_id',
        'client_secret',
        'redirect',
        'no_ig_posts',
        'access_token'
    ];
}
