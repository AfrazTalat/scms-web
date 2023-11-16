<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'code',
        'email',
        'phone_number',
        'enabled',
        'location_text',
        'location_link',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];
}
