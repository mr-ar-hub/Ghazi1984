<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'country',
        'street_address',
        'city',
        'state',
        'postal_code',
        'phone',
        'email',
        'order_note',
        'order_total',
        'payment_method',
        'status',
    ];
    public function products()
    {
        return $this->hasMany(Cart::class, 'order_id');
    }
}
