<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Resources\Admin\Content\SliderResource;
use App\Models\Content\Slider;
use App\Support\Http\CrudController;

class SliderController extends CrudController
{
    protected $model = Slider::class;

    protected $appends = ['image'];

    protected $resource = SliderResource::class;

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function toIndexQuery($query)
    {
        return $query->where('visible', true);
    }
}
