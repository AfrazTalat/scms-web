<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Requests\Admin\Common\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Common\Category\UpdateCategoryRequest;
use App\Http\Resources\Admin\Common\CategoryResource;
use App\Models\Common\Category;
use App\Support\Http\CrudController;

class CategoryController extends CrudController
{
    protected $model = Category::class;

    protected $resource = CategoryResource::class;

    protected $requests = [
        'store'  => StoreCategoryRequest::class,
        'update' => UpdateCategoryRequest::class,
    ];

    public function filters()
    {
        return [
            'search' => fn($q, $v) => $q->whereTranslationLike('name', "%{$v}%"),
        ];
    }

    public function with()
    {
        return [
            'children',
            'parent',
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function toIndexQuery($query)
    {
        return $query->whereNull('parent_id');
    }
}
