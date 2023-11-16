<?php

namespace App\Http\Resources\Admin\Users;

use App\Support\Http\JsonResourceV2;

class RoleResource extends JsonResourceV2
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'uuid'        => $this->uuid,
            'name'        => $this->name,
            'permissions' => $this->permissions ? PermissionResource::collection($this->permissions) : null,
        ];
    }
}
