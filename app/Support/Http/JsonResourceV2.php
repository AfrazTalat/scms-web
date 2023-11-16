<?php

namespace App\Support\Http;

use Illuminate\Http\Resources\Json\JsonResource;

class JsonResourceV2 extends JsonResource
{
    public static $wrap = null;

    /**
     * Undocumented function
     *
     * @param mixed $collection
     *
     * @return mixed
     */
    public static function pagination($collection)
    {
        $isPaginate = $collection instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator;
        $data       = $isPaginate ? $collection->getCollection() : $collection;
        $resource   = $isPaginate ? [
            'data'       => static::collection($data),
            'pagination' => [
                'current_page' => $collection->currentPage(),
                'total_pages'  => $collection->lastPage(),
                'from'         => $collection->firstItem(),
                'last_page'    => $collection->lastPage(),
                'to'           => $collection->lastItem(),
                'total'        => $collection->total(),
                'count'        => $collection->count(),
                'per_page'     => $collection->perPage(),
            ],
        ] : static::collection($data);
        return $resource;
    }

    public function makeWithPagination($collection)
    {
        return static::pagination($collection);
    }
}
