<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'status',
        'country_code',
        'address',
        'address2',
        'city',
        'area',
        'zip_code',
        'phone_number',
        'email',
        'notes',
        'total',
        'uuid',
    ];

    protected $casts = [
        'total' => 'float',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
