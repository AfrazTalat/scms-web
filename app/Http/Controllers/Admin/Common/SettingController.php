<?php

namespace App\Http\Controllers\Admin\Common;

use App\Models\Setting;
use App\Support\Http\CrudController;

class SettingController extends CrudController
{
    protected $model = Setting::class;

    protected $paginate_per_page = 500;

    protected $appends = ['attachment'];

    protected $media = [
        //key - the name of media name
        //value1 - file type, single for single file upload, multi for something like attachments
        //value2 - collection name if needed
        'attachment' => 'single|attachment',
    ];
}
