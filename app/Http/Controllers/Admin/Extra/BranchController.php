<?php

namespace App\Http\Controllers\Admin\Extra;

use App\Models\Common\Branch;
use App\Support\Http\CrudController;

class BranchController extends CrudController
{
    protected $model = Branch::class;
}
