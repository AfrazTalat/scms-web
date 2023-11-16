<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Resources\Admin\Users\RoleResource;
use App\Models\Role;
use App\Support\Http\CrudController;

class RolesController extends CrudController
{
    protected $model = Role::class;

    protected $paginate_per_page = 100;

    protected $resource = RoleResource::class;

    protected $searchable = [
        'name',
    ];

    protected $sortable = [
        'id',
    ];

    protected function with()
    {
        return [
            'permissions',
        ];
    }
}
