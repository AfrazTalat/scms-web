<?php

namespace App\Http\Resources\Web\Ecommerce;

use App\Http\Resources\PreviewableMediaFile;
use App\Http\Resources\Web\Common\BrandResource;
use App\Http\Resources\Web\Common\CategoryResource;
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
            'brand'         => $this->brand ? BrandResource::make($this->brand) : null,
            'category'      => $category ? CategoryResource::make($category) : null,
            'images'        => $this->images ? PreviewableMediaFile::collection($this->images) : null,
            'pdf'           => $this->pdf ? PreviewableMediaFile::make($this->pdf) : null,
            'price'         => $this->price,
            'stock_qty'     => $this->stock_qty,
            'trashed_at'    => $this->trashed_at,
            'deleted_at'    => $this->deleted_at,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'youtube_video' => $this->youtube_video,
        ];
    }
}
