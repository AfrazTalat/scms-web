<?php

namespace App\Models\Content;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Project extends Model implements TranslatableContract, HasMedia
{
    use Translatable, InteractsWithMedia;

    public $translatedAttributes = ['title', 'content'];

    protected $fillable = [
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function getImagesAttribute()
    {
        return $this->getMedia('images');
    }
}
