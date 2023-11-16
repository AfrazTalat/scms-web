<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Requests\Admin\Content\Project\StoreProjectRequest;
use App\Http\Resources\Admin\Content\ProjectResource;
use App\Models\Content\Project;
use App\Support\Http\CrudController;

class ProjectController extends CrudController
{
    protected $model = Project::class;

    protected $resource = ProjectResource::class;

    protected $requests = [
        'store'  => StoreProjectRequest::class,
        'update' => StoreProjectRequest::class,
    ];
    
    protected $appends = ['images'];

    protected $media = [
        //key - the name of media name
        //value1 - file type, single for single file upload, multi for something like attachments
        //value2 - collection name if needed
        'images' => 'multi|images',
    ];

    protected $sort_by = ['updated_at' => 'desc'];
}
