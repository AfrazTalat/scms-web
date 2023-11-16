<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Resources\Admin\Users\PermissionResource;
use App\Models\Permission;
use App\Support\Http\CrudController;

class PermissionController extends CrudController
{
    protected $model = Permission::class;

    protected $paginate_per_page = 100;

    protected $resource = PermissionResource::class;


    protected $searchable = [
        'name',
    ];

    protected $sortable = [
        'id',
    ];
}
