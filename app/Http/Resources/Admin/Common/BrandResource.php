<?php

namespace App\Http\Resources\Admin\Common;

use App\Http\Resources\PreviewableMediaFile;
use App\Support\Http\JsonResourceV2;

class BrandResource extends JsonResourceV2
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
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'is_enabled'   => $this->is_enabled,
            'featured'     => $this->featured,
            'logo'         => PreviewableMediaFile::make($this->whenAppended('logo')),
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'translations' => $this->getTranslationsArray(),
        ];
    }
}
