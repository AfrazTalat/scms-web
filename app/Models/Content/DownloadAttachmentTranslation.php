<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class DownloadAttachmentTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'description'];
}
