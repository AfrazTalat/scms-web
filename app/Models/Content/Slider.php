<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    /**
     * @return mixed
     */
    public function getImageAttribute()
    {
        return $this->getFirstMedia('image');
    }
}
