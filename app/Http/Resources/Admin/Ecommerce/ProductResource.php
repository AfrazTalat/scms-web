<?php

namespace App\Http\Resources\Admin\Ecommerce;

use App\Http\Resources\Admin\Common\BrandResource;
use App\Http\Resources\Admin\Common\CategoryResource;
use App\Http\Resources\PreviewableMediaFile;
use App\Support\Http\JsonResourceV2;

class ProductResource extends JsonResourceV2
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $category = $this->categories()->first();
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'subtitle'      => $this->subtitle,
            'hidden'        => $this->hidden,
            'featured'      => $this->featured,
            'brand'         => BrandResource::make($this->whenLoaded('brand')),
            'category'      => $category ? CategoryResource::make($category) : null,
            'images'        => PreviewableMediaFile::collection($this->whenAppended('images')),
            'pdf'           => PreviewableMediaFile::make($this->whenAppended('pdf')),
            'price'         => $this->price,
            'stock_qty'     => $this->stock_qty,
            'trashed_at'    => $this->trashed_at,
            'deleted_at'    => $this->deleted_at,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'youtube_video' => $this->youtube_video,
            'translations'  => $this->getTranslationsArray(),
        ];
    }
}
