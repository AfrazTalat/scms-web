<?php

namespace Database\Seeders\Users;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * @var array|\Illuminate\Support\Collection
     */
    public $roles = [
        ['name' => 'administrator'],
        ['name' => 'user'],
    ];

    /**
     * @var array|\Illuminate\Support\Collection
     */
    public $permissions = [
        'access'      => [
            ['name' => 'access_admin_panel'],
            ['name' => 'access_translations'],
            ['name' => 'access_settings'],
        ],
        'users'       => [
            ['name' => 'users_list'],
            ['name' => 'users_create'],
            ['name' => 'users_delete'],
            ['name' => 'users_update'],
        ],
        'roles'       => [
            ['name' => 'roles_list'],
            ['name' => 'roles_create'],
            ['name' => 'roles_delete'],
            ['name' => 'roles_update'],
        ],
        'permissions' => [
            ['name' => 'permissions_list'],
            ['name' => 'permissions_create'],
            ['name' => 'permissions_delete'],
            ['name' => 'permissions_update'],
        ],
        'categories'  => [
            ['name' => 'categories_list'],
            ['name' => 'categories_create'],
            ['name' => 'categories_delete'],
            ['name' => 'categories_update'],
        ],
        'brands'      => [
            ['name' => 'brands_list'],
            ['name' => 'brands_create'],
            ['name' => 'brands_delete'],
            ['name' => 'brands_update'],
        ],
        'products'    => [
            ['name' => 'products_list'],
            ['name' => 'products_create'],
            ['name' => 'products_delete'],
            ['name' => 'products_update'],
        ],
        'orders'      => [
            ['name' => 'orders_list'],
            ['name' => 'orders_create'],
            ['name' => 'orders_delete'],
            ['name' => 'orders_update'],
        ],
        'articles'    => [
            ['name' => 'articles_list'],
            ['name' => 'articles_create'],
            ['name' => 'articles_delete'],
            ['name' => 'articles_update'],
        ],
        'pages'       => [
            ['name' => 'pages_list'],
            ['name' => 'pages_create'],
            ['name' => 'pages_delete'],
            ['name' => 'pages_update'],
        ],
        'projects'    => [
            ['name' => 'projects_list'],
            ['name' => 'projects_create'],
            ['name' => 'projects_delete'],
            ['name' => 'projects_update'],
        ],
        'partners'    => [
            ['name' => 'partners_list'],
            ['name' => 'partners_create'],
            ['name' => 'partners_delete'],
            ['name' => 'partners_update'],
        ],
        'branches'    => [
            ['name' => 'branches_list'],
            ['name' => 'branches_create'],
            ['name' => 'branches_delete'],
            ['name' => 'branches_update'],
        ],
        'sliders'     => [
            ['name' => 'sliders_list'],
            ['name' => 'sliders_create'],
            ['name' => 'sliders_delete'],
            ['name' => 'sliders_update'],
        ],
    ];

    /**
     * Run the database seeders_
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles()->createPermissions()->assignAllPermissionsToAdminRole();
    }

    /**
     * @return $this
     */
    public function createRoles()
    {
        $this->roles = collect($this->roles)->map(function ($role) {
            return Role::updateOrCreate(['name' => $role['name']], $role);
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function createPermissions()
    {
        $this->permissions = collect($this->permissions)->map(function ($group) {
            return collect($group)->map(function ($permission) {
                return Permission::updateOrCreate(['name' => $permission['name']], $permission);
            });
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function assignAllPermissionsToAdminRole()
    {
        $role = Role::where('name', 'Administrator')->firstOrFail();
        $this->permissions->flatten()->each(function ($permission) use ($role) {
            $role->givePermissionTo($permission);
        });

        return $this;
    }
}
