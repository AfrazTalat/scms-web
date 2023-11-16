<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    public $timestamps  = false;
    protected $fillable = ['title', 'content'];
}
