<?php

namespace App\Http\Resources;

use App\Support\Http\JsonResourceV2 as HttpJsonResourceV2;

class PreviewableMediaFile extends HttpJsonResourceV2
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'file'    => null,
            'preview' => $this->getUrl(),
            'type'    => $this->mime_type,
            'name'    => $this->file_name,
        ];
    }
}
