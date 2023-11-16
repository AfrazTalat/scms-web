<?php

namespace App\Models\Common;

use App\Models\Ecommerce\Product;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements TranslatableContract, HasMedia
{
    use Translatable, InteractsWithMedia;

    public $translatedAttributes = ['name', 'description'];

    protected $fillable = [
        'is_enabled',
        'featured',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'featured'   => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return mixed
     */
    public function getLogoAttribute()
    {
        return $this->getFirstMedia('logo');
    }

    /**
     * @return int
     */
    public function getProductsCountAttribute()
    {
        return $this->products()->public()->count();
    }
}
