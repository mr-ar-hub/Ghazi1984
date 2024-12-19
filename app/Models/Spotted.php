<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spotted extends Model
{
    use HasFactory;
    protected $table = 'spotted';
    
    protected $fillable = [
        'name',
        'order_no',
        'status',
    ];
    public function SpottedImage(){
        return $this->hasOne(SpottedImages::class, 'spotted_uuid', 'id');
    }
}
