<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Requests\Admin\Content\Page\StorePageRequest;
use App\Http\Resources\Admin\Content\PageResource;
use App\Models\Content\Page;
use App\Support\Http\CrudController;

class PageController extends CrudController
{
    protected $model = Page::class;

    protected $resource = PageResource::class;

    protected $requests = [
        'store'  => StorePageRequest::class,
        'update' => StorePageRequest::class,
    ];

    protected $sort_by = ['updated_at' => 'desc'];
}
