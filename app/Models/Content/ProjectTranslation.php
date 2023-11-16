<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'content'];
}
