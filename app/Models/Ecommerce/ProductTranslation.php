<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps  = false;
    protected $fillable = ['name', 'description', 'subtitle'];
}
