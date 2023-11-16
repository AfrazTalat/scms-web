<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Http\Resources\Web\Ecommerce\ProductResource;
use App\Models\Ecommerce\Product;
use App\Support\Http\CrudController;

class ProductController extends CrudController
{
    protected $model    = Product::class;
    protected $resource = ProductResource::class;
    protected $appends  = ['images'];

    public function with()
    {
        return [
            'brand',
        ];
    }

    protected function filters()
    {
        return [
            'brand_id'    => fn($q, $v)    => $q->whereHasBrand($v),
            'category_id' => fn($q, $v) => $q->whereInCategory($v),
            'search'      => fn($q, $v)      => $q->when(
                $v,
                fn($sq) => $sq->where(
                    fn($ssq) => $ssq->whereTranslationLike("name", "{$v}%")
                        ->orWhereTranslationLike("subtitle", "{$v}%")
                        ->orWhereTranslationLike("description", "{$v}%")
                )
            ),
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function toIndexQuery($query)
    {
        return $query->orderable();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function toShowQuery($query)
    {
        return $query->orderable();
    }
}
