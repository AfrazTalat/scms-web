<?php

namespace App\Models;

use App\Support\HasRolesUuid;
use App\Support\HasSocialLogin;
use App\Support\UuidScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use Notifiable, UuidScopeTrait, HasFactory, HasApiTokens, HasRoles, SoftDeletes, HasSocialLogin, HasRolesUuid {
        HasRolesUuid::getStoredRole insteadof HasRoles;
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'uuid',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $appends = ['name'];
   

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $model) {
            $model->password = Hash::make($model->password);
        });

        static::updating(function (self $model) {
            if ($model->attributes['password'] == null) {
                unset($model->attributes['password']);
            }
            if (isset($model->attributes['password']) && $model->attributes['password'] != null) {
                $model->password = Hash::make($model->password);
            }
        });
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }
    
    /**
     * Returns the current session user, or null if user is logged out.
     *
     * @return static|null
     */
    public static function auth()
    {
        return auth()->user();
    }
    

    public function create(array $attributes = [])
    {
        if (array_key_exists('password', $attributes)) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        $model = static::query()->create($attributes);

        return $model;
    }
    
    /**
    * @return string
    */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
