<?php

namespace App\Http\Controllers\Api\Extra;

use App\Models\Common\Branch;
use App\Support\Http\CrudController;

class BranchController extends CrudController
{
    protected $model = Branch::class;

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function toIndexQuery($query)
    {
        return $query->where(['enabled' => true]);
    }
}
