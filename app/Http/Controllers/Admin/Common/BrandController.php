<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Requests\Admin\Common\Brand\StoreBrandRequest;
use App\Http\Requests\Admin\Common\Brand\UpdateBrandRequest;
use App\Http\Resources\Admin\Common\BrandResource;
use App\Models\Common\Brand;
use App\Support\Http\CrudController;

class BrandController extends CrudController
{
    protected $model = Brand::class;

    protected $resource = BrandResource::class;

    protected $requests = [
        'store'  => StoreBrandRequest::class,
        'update' => UpdateBrandRequest::class,
    ];

    protected $appends = ['logo'];

    protected $media = [
        //key - the name of media name
        //value1 - file type, single for single file upload, multi for something like attachments
        //value2 - collection name if needed
        'logo' => 'single|logo',
    ];

    public function filters()
    {
        return [
            'search' => fn($q, $v) => $q->whereTranslationLike('name', "%{$v}%"),
        ];
    }
}
