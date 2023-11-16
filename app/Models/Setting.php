<?php

namespace App\Models;

use App\Http\Resources\PreviewableMediaFile;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $timestamps = false;

    protected $fillable = [
        'group',
        'key',
        'value',
    ];

    /**
     *
     * @param string $key
     *
     * @return static|null
     */
    public static function findKey($key)
    {
        return static::where('key', $key)->first();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachment');
    }

    public function getAttachmentAttribute()
    {
        $media = $this->getFirstMedia('attachment');
        if (!$media) {
            return null;
        }
        return PreviewableMediaFile::make($media);
    }
}
