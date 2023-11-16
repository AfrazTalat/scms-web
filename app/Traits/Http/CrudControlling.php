<?php

namespace App\Traits\Http;

use App;
use Arr;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use League\Fractal\TransformerAbstract;

trait CrudControlling
{
    private function hasProp(string $name)
    {
        return property_exists($this, $name);
    }

    public function getModel(): Model | Collection | EloquentBuilder | null
    {
        if (!$this->hasProp('model')) {
            return null;
        }
        return $this->model ? app($this->model) : null;
    }

    public function getTransformer(): TransformerAbstract | null
    {
        if (!$this->hasProp('transformer')) {
            return null;
        }
        return $this->transformer ? app($this->transformer) : null;
    }

    public function getResource(): string | null
    {
        if (!$this->hasProp('resource')) {
            return null;
        }
        return $this->resource ?? null;
    }

    public function getSortBy(): array | null
    {
        if (!$this->hasProp('sort_by')) {
            return null;
        }
        return $this->sort_by ?? null;
    }

    public function getWith(): array | null
    {
        if (!method_exists($this, 'with')) {
            return null;
        }
        return $this->with() ?? null;
    }

    public function getRequests(): array | null
    {
        if (!$this->hasProp('requests')) {
            return null;
        }
        return $this->requests ?? null;
    }

    public function getRequest(string $name): string | null
    {
        if (!$this->hasProp('requests')) {
            return null;
        }
        return $this->requests[$name] ?? null;
    }

    public function getSearchable(): array | null
    {
        if (!$this->hasProp('searchable')) {
            return null;
        }
        return $this->searchable;
    }

    public function getSortable(): array | null
    {
        if (!$this->hasProp('sortable')) {
            return null;
        }
        return $this->sortable;
    }

    private function crudRequest(string $name): FormRequest
    {
        $crudRequestClass = $this->getRequest($name);
        if ($crudRequestClass) {
            return app($crudRequestClass);
        }
        return false;
    }

    private function buildResponse($data, $paginate = false)
    {
        $resource = $this->getResource();
        if ($resource) {
            return $paginate ?
            call_user_func([$resource, 'pagination'], $data) :
            call_user_func([$resource, 'make'], $data);
        }
        $transformer = $this->getTransformer();
        return $transformer ? fractal($data, $transformer)->respond() : $data;
    }

    public function index()
    {
        $request     = $this->crudRequest('index');
        $sortByArray = $this->getSortBy();
        $with        = $this->getWith();
        $query       = $this->getModel()
            ->when($with && count($with) > 0, function ($q) use ($with) {
                $q->with($with);
            })
            ->when($sortByArray != null && count($sortByArray) > 0, function ($q) use ($sortByArray) {
                foreach ($sortByArray as $key => $value) {
                    $q->orderBy($key, $value);
                }
            });
        $paginator = $query->paginate($this->paginate_per_page ?? 15);
        return $this->buildResponse($paginator, true);
    }

    public function store()
    {
        $request = $this->crudRequest('store');
        $model   = $this->getModel()->create($request->validated());
        $with    = $this->getWith();
        if ($with && count($with) > 0) {
            $withIsAssoc = array_keys($with) !== range(0, count($with) - 1);
            foreach ($with as $key => $value) {
                $withName = $withIsAssoc ? $key : $value;
                if ($request->has($withName)) {
                    $model->$withName()->sync($request->$withName);
                }
            }
            $model->load($with);
        }
        return $this->buildResponse($model);
    }

    public function show()
    {
        $request = $this->crudRequest('show');
        $id      = request()->route('id');
        $model   = $this->getModel()->findOrFail($id);
        $model->load($this->getWith());
        return $this->buildResponse($model);
    }

    public function update()
    {
        $request = $this->crudRequest('update');
        $id      = request()->route('id');
        $model   = $this->getModel()->findOrFail($id);
        $model->update(Arr::where($request->validated(), fn($in) => $in != null));
        $with = $this->getWith();
        if ($with && count($with) > 0) {
            $withIsAssoc = array_keys($with) !== range(0, count($with) - 1);
            foreach ($with as $key => $value) {
                $withName = $withIsAssoc ? $key : $value;
                if ($request->has($withName)) {
                    $model->$withName()->sync($request->$withName);
                }
            }
            $model->load($with);
        }
        return $this->buildResponse($model);
    }

    public function destroy()
    {
        $request = $this->crudRequest('delete');
        $id      = request()->route('id');
        $model   = $this->getModel()->find($id);
        if ($model) {
            $model->delete();
        }
        return res()->success();
    }
}
