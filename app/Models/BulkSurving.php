<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkSurving extends Model
{
    use HasFactory;
    protected $table = 'bluk_serving';

    protected $fillable = [
        'name',
        'company_name',
        'bluk_serving_description',
        'status'
    ];
    public function BulkSurvingImage(){
        return $this->hasOne(BulkSurvingImages::class, 'bluk_serving_uuid', 'id');
    }
}
