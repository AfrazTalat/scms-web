<?php

namespace App\Http\Resources\Admin\Content;

use App\Http\Resources\PreviewableMediaFile;
use App\Support\Http\JsonResourceV2;

class ProjectResource extends JsonResourceV2
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
            'title'        => $this->title,
            'visible'      => $this->visible,
            'content'      => $this->content,
            'images'       => $this->images ? PreviewableMediaFile::collection($this->images) : null,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'translations' => $this->getTranslationsArray(),
        ];
    }
}
