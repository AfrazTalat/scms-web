<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Models\Ecommerce\Order;
use App\Support\Http\CrudController;
use Illuminate\Http\Request;

class OrderController extends CrudController
{
    protected $model = Order::class;

    protected $sort_by = ['id' => 'desc'];

    public function with()
    {
        return [
            'items',
        ];
    }

    public function updateStatus(Request $request)
    {
        $request->validate(['status' => 'required|string|in:pending,confirmed,canceled']);
        $id    = $request->route($this->getPrimaryKey());
        $model = $this->getModel()->query()->where($this->getPrimaryKey(), $id)->firstOrFail();
        $model->update(['status' => $request->status]);
        return res()->success("Order updated", $model);
    }
}
