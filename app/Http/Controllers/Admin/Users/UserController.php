<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Http\Resources\Admin\Users\UserResource;
use App\Models\User;
use App\Support\Http\CrudController;

class UserController extends CrudController
{
    protected $model = User::class;

    protected $paginate_per_page = 15;

    protected $sort_by = ['id' => 'asc'];

    protected $resource = UserResource::class;

    protected $requests = [
        'store'  => StoreUserRequest::class,
        'update' => UpdateUserRequest::class,
    ];

    public function filters()
    {
        return [
            'role'   => fn($q, $v)   => $q->role($v),
            'search' => fn($q, $v) => $q->where(fn($sq) => $sq->where('first_name', 'LIKE', "%{$v}%")->orWhere('last_name', 'LIKE', "%{$v}%")),
        ];
    }

    protected $searchable = [
        'first_name',
        'last_name',
        'email',
    ];

    protected $sortable = [
        'id',
    ];

    protected function with()
    {
        return [
            'roles',
        ];
    }
}
