<?php

namespace App\Models\Content;

use App\Http\Resources\PreviewableMediaFile;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements TranslatableContract, HasMedia
{
    use Translatable, InteractsWithMedia;

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = [
        'hidden',
    ];

    protected $casts = [
        'hidden' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('banner')->singleFile();
    }

    /**
     * @return mixed
     */
    public function getBannerAttribute()
    {
        $media = $this->getFirstMedia('banner');
        if (!$media) {
            return $media;
        }
        return PreviewableMediaFile::make($media);
    }
}
