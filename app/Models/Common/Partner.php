<?php

namespace App\Models\Common;

use App\Http\Resources\PreviewableMediaFile;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'featured',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
    }

    /**
     * @return mixed
     */
    public function getLogoAttribute()
    {
        $media = $this->getFirstMedia('logo');
        if (!$media) {
            return $media;
        }
        return PreviewableMediaFile::make($media);
    }
}
