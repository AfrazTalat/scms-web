<?php

namespace App\Http\Controllers\Api\Common;

use App\Models\Setting;
use App\Support\Http\CrudController;

class SettingController extends CrudController
{
    protected $model = Setting::class;

    protected $paginate_per_page = 500;

    protected $appends = ['attachment'];
}
