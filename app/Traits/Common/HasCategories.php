<?php

namespace App\Traits\Common;

use App\Models\Common\Category;

trait HasCategories
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereInCategory($query, int | string | array $categories)
    {
        if (!is_array($categories)) {
            $categories = [$categories];
        }
        return $query->whereHas('categories', fn($q) => $q->whereIn('categorizables.category_id', $categories));
    }
}
