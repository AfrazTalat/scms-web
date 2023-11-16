<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Resources\Web\Common\BrandResource;
use App\Models\Common\Brand;
use App\Support\Http\CrudController;

class BrandController extends CrudController
{
    protected $model = Brand::class;

    protected $resource = BrandResource::class;

    protected $appends = ['logo', 'products_count'];
}
