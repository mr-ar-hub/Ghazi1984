<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleImages extends Model
{
    use HasFactory;
    protected $table = 'sample_images';
    protected $fillable = [
        'image_name',
        'bluk_uuid',
    ];
    public function bulkOrder()
    {
        return $this->belongsTo(BulkOrder::class, 'bluk_uuid', 'id');
    }
}
