<?php

namespace App\Http\Resources\Web\Common;

use App\Support\Http\JsonResourceV2;

class CategoryResource extends JsonResourceV2
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $parent = $this->categories()->first();
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'description'       => $this->description,
            'is_enabled'        => $this->is_enabled,
            'featured'          => $this->featured,
            // 'parent'      => $parent ? CategoryResource::make($parent) : null,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
