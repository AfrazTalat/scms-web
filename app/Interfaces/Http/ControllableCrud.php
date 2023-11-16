<?php

namespace App\Interfaces\Http;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

interface ControllableCrud
{
    public function getModel(): Model | Collection | EloquentBuilder | null;
    public function getTransformer(): TransformerAbstract | null;
    public function getRequests(): array | null;
    public function getRequest(string $name): string | null;
    public function getSearchable(): array | null;
    public function getSortable(): array | null;
    public function index();
    public function store();
    public function show();
    public function update();
    public function destroy();
}
