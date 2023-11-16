<?php

namespace App\Traits\Common;

use App\Models\Common\Brand;

trait HasBrand
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereHasBrand($query, int | string $brand_id)
    {
        return $query->where('brand_id', $brand_id);
    }
}
