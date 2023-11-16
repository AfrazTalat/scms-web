<?php

namespace App\Transformers\Users;

use App\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 */
class UserTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['role'];

    /**
     * @param \App\Model\User $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => $model->uuid,
            'name'       => $model->name,
            'email'      => $model->email,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }

    /**
     * @param \App\Model\User $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRole(User $model)
    {
        $role = $model->roles->first();
        if (!$role) {
            return null;
        }

        return $this->item($model->roles->first(), new RoleTransformer())->getData();
    }
}
