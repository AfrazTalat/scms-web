<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Resources\Web\Content\PageResource;
use App\Models\Content\Page;
use App\Support\Http\CrudController;

class PageController extends CrudController
{
    protected $model = Page::class;

    protected $resource = PageResource::class;

    protected $primaryKey = 'slug';

    protected $sort_by = ['updated_at' => 'desc'];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function toShowQuery($query)
    {
        return $query->where('visible', true);
    }
}
