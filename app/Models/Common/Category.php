<?php

namespace App\Models\Common;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $fillable = [
        'is_enabled',
        'featured',
        'parent_id',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'featured'   => 'boolean',
    ];

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }
}
