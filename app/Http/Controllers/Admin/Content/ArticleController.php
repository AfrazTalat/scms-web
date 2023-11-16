<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Requests\Admin\Content\Article\StoreArticleRequest;
use App\Http\Resources\Admin\Content\ArticleResource;
use App\Models\Content\Article;
use App\Support\Http\CrudController;

class ArticleController extends CrudController
{
    protected $model = Article::class;

    protected $resource = ArticleResource::class;

    protected $requests = [
        'store'  => StoreArticleRequest::class,
        'update' => StoreArticleRequest::class,
    ];

    protected $sort_by = ['updated_at' => 'desc'];

    // protected $resource = BrandResource::class;

    protected $appends = ['banner'];

    protected $media = [
        //key - the name of media name
        //value1 - file type, single for single file upload, multi for something like attachments
        //value2 - collection name if needed
        'banner' => 'single|banner',
    ];
}
