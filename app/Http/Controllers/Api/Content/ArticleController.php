<?php

namespace App\Http\Controllers\Api\Content;

use App\Models\Content\Article;
use App\Support\Http\CrudController;

class ArticleController extends CrudController
{
    protected $model = Article::class;

    protected $sort_by = ['updated_at' => 'desc'];

    protected $appends = ['banner'];
}
