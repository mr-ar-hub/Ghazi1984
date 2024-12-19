<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = [
        'size',
        'color',
        'gender',
        'quantity',
        'product_id',
        'session_id',
        'order_id',
        'user_id'
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
