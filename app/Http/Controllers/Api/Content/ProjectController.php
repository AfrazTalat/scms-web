<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Resources\Web\Content\ProjectResource;
use App\Models\Content\Project;
use App\Support\Http\CrudController;

class ProjectController extends CrudController
{
    protected $model = Project::class;

    protected $resource = ProjectResource::class;

    protected $appends  = ['images'];

    protected $sort_by = ['updated_at' => 'desc'];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function toShowQuery($query)
    {
        return $query->where('visible', true);
    }
}
