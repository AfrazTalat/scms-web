<?php

namespace App\Models;

use App\Http\Exceptions\ApiException;
use App\Support\HasPermissionsUuid;
use App\Support\UuidScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Role.
 */
class Role extends \Spatie\Permission\Models\Role
{
    use UuidScopeTrait, HasPermissionsUuid, HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'uuid', 'guard_name'];

    public static function boot()
    {
        parent::boot();

        // static::creating(function (self $model) {
        //     if (in_array($model->name, ['administrator', 'user'])) {
        //         throw new ApiException("Cannot use these names for roles");
        //     }
        // });

        static::updating(function (self $model) {
            if (in_array($model->getOriginal('name'), ['administrator', 'user'])) {
                throw new ApiException("Cannot use these names for roles");
            }
        });
    }
}
