<?php

namespace App\Http\Controllers\Api\Extra;

use App\Models\Common\Partner;
use App\Support\Http\CrudController;

class PartnerController extends CrudController
{
    protected $model = Partner::class;

    protected $appends = ['logo'];
}
