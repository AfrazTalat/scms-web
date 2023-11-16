<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'qty',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
