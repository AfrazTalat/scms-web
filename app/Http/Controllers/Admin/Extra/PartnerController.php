<?php

namespace App\Http\Controllers\Admin\Extra;

use App\Models\Common\Partner;
use App\Support\Http\CrudController;

class PartnerController extends CrudController
{
    protected $model = Partner::class;

    protected $appends = ['logo'];

    protected $media = [
        //key - the name of media name
        //value1 - file type, single for single file upload, multi for something like attachments
        //value2 - collection name if needed
        'logo' => 'single|logo',
    ];
}
