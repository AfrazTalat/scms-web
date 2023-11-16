<?php

namespace App\Http\Resources\Web\Content;

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
            'id'         => $this->id,
            'title'      => $this->title,
            'slug'       => $this->slug,
            'visible'    => $this->visible,
            'content'    => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'images'     => $this->images ? PreviewableMediaFile::collection($this->images) : null,
        ];
    }
}
