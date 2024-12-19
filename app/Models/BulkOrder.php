<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkOrder extends Model
{
    use HasFactory;
    protected $table = 'bulk_order';
    protected $fillable = [
        'name',
        'email',
        'company_name',
        'phone',
        'address',
        'country',
        'quantity',
        'requirement',
        'status'
    ];
    public function SampleImage(){
        return $this->hasMany(SampleImages::class, 'bluk_uuid', 'id');
    }
}
