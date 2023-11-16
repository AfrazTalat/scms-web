<?php

namespace App\Models\Content;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DownloadAttachment extends Model implements TranslatableContract, HasMedia
{
    use Translatable, InteractsWithMedia;

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = [
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')->singleFile();
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file')->first();
    }
}
