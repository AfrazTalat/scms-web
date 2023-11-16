<?php

namespace App\Http\Controllers\Api\Common;

use App\Models\Common\Category;
use App\Support\Http\CrudController;

class CategoryController extends CrudController
{
    protected $model = Category::class;

    protected function filters()
    {
        return [
            'featured'  => fn($q, $v)  => $q->where('featured', $v),
            'main_only' => fn($q, $v) => $q->when(
                $v == true,
                fn($sq) => $sq->whereNull('parent_id')
            ),
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function toIndexQuery($query)
    {
        return $query->where(['is_enabled' => true]);
    }
}
