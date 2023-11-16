<?php

namespace App\Http\Resources\Web\Users;

use App\Support\Http\JsonResourceV2;

class PermissionResource extends JsonResourceV2
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
            'id'   => $this->id,
            'uuid' => $this->uuid,
            'name' => "user.permissions.{$this->name}",
        ];
    }
}
