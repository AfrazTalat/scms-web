<?php

namespace App\Models\Ecommerce;

use App\Traits\Common\HasBrand;
use App\Traits\Common\HasCategories;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements TranslatableContract, HasMedia
{
    use Translatable, HasCategories, HasBrand, InteractsWithMedia;

    public $translatedAttributes = ['name', 'description', 'subtitle'];

    protected $fillable = [
        'price',
        'cost',
        'net',
        'stock_qty',
        'brand_id',
        'hidden',
        'trashed_at',
        'deleted_at',
        'featured',
        'youtube_video',
    ];

    protected $casts = [
        'price'      => 'float',
        'cost'       => 'float',
        'net'        => 'float',
        'stock_qty'  => 'int',
        'hidden'     => 'boolean',
        'trashed_at' => 'datetime',
        'deleted_at' => 'datetime',
        'featured'   => 'boolean',
    ];


    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        $this->description;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('pdf')->singleFile();
    }
    

    /**
     * @return mixed
     */
    public function getImagesAttribute()
    {
        return $this->getMedia('images');
    }
    

    /**
     * @return mixed
     */
    public function getPdfAttribute()
    {
        return $this->getFirstMedia('pdf');
    }

    /**
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopePublic($query)
    {
        return $query->where('hidden', false);
    }

    /**
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeOrderable($query)
    {
        return $query->public();
    }
}
