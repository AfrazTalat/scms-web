<?php

namespace App\Http\Resources\Web\Users;

use App\Support\Http\JsonResourceV2;

class UserResource extends JsonResourceV2
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $role = $this->roles->first();
        return [
            'id'         => $this->id,
            'uuid'       => $this->uuid,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'name'       => $this->name,
        ];
    }
}
