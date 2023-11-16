<?php

namespace App\Support\Http;

use App\Http\Controllers\Controller;
use App\Http\Exceptions\ApiException;
use Arr;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

class CrudController extends Controller
{
    /**
     * @var string|null
     */
    protected $model = null;

    /**
     * @var string|null
     */
    protected $primaryKey = null;

    /**
     * @var int|null
     */
    protected $paginate_per_page = 500;

    /**
     * @var array|null
     */
    protected $sort_by = null;

    /**
     * @var string|null
     */
    protected $resource = null;

    /**
     * @var array|null
     */
    protected $requests = null;

    /**
     * @var array|null
     */
    protected $searchable = null;

    /**
     * @var array|null
     */
    protected $sortable = null;

    /**
     * @var array|null
     */
    protected $filterable = null;

    protected function with()
    {
        return null;
    }

    protected function filters()
    {
        return null;
    }

    private function hasProp(string $name)
    {
        return property_exists($this, $name);
    }

    private function hasMethod(string $name)
    {
        return method_exists($this, $name);
    }

    public function getModel(): Model | Collection | EloquentBuilder | null
    {
        if (!$this->hasProp('model')) {
            return null;
        }
        return $this->model ? app($this->model) : null;
    }

    public function getPrimaryKey(): string
    {
        return $this->primaryKey ?? 'id';
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
        $hasTranslations = $this->modelHasTranslation();
        if (!method_exists($this, 'with')) {
            return $hasTranslations ? ['translations'] : null;
        }
        return $this->with() ?? ($hasTranslations ? ['translations'] : null);
    }

    public function getFilters(): array | null
    {
        if (!method_exists($this, 'filters')) {
            return null;
        }
        return $this->filters() ?? null;
    }

    public function getMedia(): array | null
    {
        if (!$this->hasProp('media')) {
            return null;
        }
        return $this->media ?? null;
    }

    public function getAppends(): array | null
    {
        if (!$this->hasProp('appends')) {
            return [];
        }
        return $this->appends ?? [];
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

    private function crudRequest(string $name): FormRequest | Request
    {
        $crudRequestClass = $this->getRequest($name);
        if ($crudRequestClass) {
            return app($crudRequestClass);
        }
        return request();
    }

    /**
     * @param \Illuminate\Foundation\Http\FormRequest|\Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder $model
     */
    private function handleRequestRelationships($request, $model)
    {
        $withArray = $this->getWith();
        if (!$withArray || count($withArray) === 0) {
            return;
        }
        $withIsAssoc = array_keys($withArray) !== range(0, count($withArray) - 1);
        foreach ($withArray as $key => $value) {
            $withName = $withIsAssoc ? $key : $value;
            if ($request->has($withName)) {
                if (method_exists($model->$withName(), 'sync')) {
                    $model->$withName()->sync($request->$withName);
                }
            }
        }
        $model->load($withArray);
    }

    /**
     * @param \Illuminate\Foundation\Http\FormRequest|\Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model|\Spatie\MediaLibrary\InteractsWithMedia|\Spatie\MediaLibrary\HasMedia|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder $model
     */
    private function handleRequestMedia($request, $model)
    {
        $mediaArray = $this->getMedia();
        if (!$mediaArray || count($mediaArray) === 0) {
            return;
        }
        foreach ($mediaArray as $param => $options) {
            $collection = null;
            $type       = 'single';
            if ($options) {
                list($type, $collection) = explode('|', $options);
            }

            if ($type === 'single') {
                if ($request->has($param) && !$request->hasFile($param)) {
                    if ($request->get($param) == null || $request->get($param) == "null") {
                        $deleted = $collection ?
                        $model->clearMediaCollection($collection) :
                        $model->getFirstMedia()->delete();
                    }
                } elseif ($request->hasFile($param)) {
                    // logger($request->file($param));
                    $query = $model->addMedia($request->file($param));
                    // $query = $model->addMediaFromRequest($param);
                    if ($collection) {
                        $query->toMediaCollection($collection);
                    }
                }
            } elseif ($type !== 'single' && $request->$param) {
                $mediaItems = $request->$param;
                if (!is_array($mediaItems) || count($mediaItems) === 0) {
                    $deleted = $collection ?
                    $model->clearMediaCollection($collection) :
                    $model->getMedia()->each(fn($md) => $md->delete());
                    continue;
                }
                $requestMediaIds = $request->get("{$param}_ids", null);
                if (!$requestMediaIds) {
                    continue;
                }
                $modelMedia = $model->getMedia($collection);
                $idsDiff    = array_diff($modelMedia->pluck('id')->toArray(), $requestMediaIds);
                $modelMedia->whereIn('id', $idsDiff)->each(function ($file) {
                    $file->delete();
                });
                foreach ($mediaItems as $item) {
                    if (!$item || $item === null || is_string($item)) {
                        continue;
                    }
                    $query = $model->addMedia($item);
                    if ($collection) {
                        $query->toMediaCollection($collection);
                    }
                }
            }
        }
    }

    private function modelHasTranslation()
    {
        return property_exists($this->getModel(), 'translatedAttributes');
    }

    /**
     * @param array $attributes
     */
    private function handleTranslatableAttributes($attributes, $isStore = false)
    {
        $translations = isset($attributes['translations']) && $attributes['translations']
        ? $attributes['translations']
        : request()->get('translations');
        if (is_string($translations)) {
            $translations = json_decode($translations, true);
        }
        if (!$translations || !$this->modelHasTranslation()) {
            return $attributes;
        }

        $returnAttributes = $attributes;
        $translatable     = $this->getModel()->translatedAttributes;
        if (count($translatable) === 0) {
            return $returnAttributes;
        }
        foreach ($translatable as $key) {
            unset($returnAttributes[$key]);
        }
        foreach ($translations as $locale => $fields) {
            $returnAttributes[$locale] = $fields;
        }

        return $returnAttributes;
    }

    private function buildResponse($data, $paginate = false, $alert = true)
    {
        $returnData = null;
        $resource   = $this->getResource();
        if ($resource) {
            $returnData = $paginate ? $resource::pagination($data) : $resource::make($data);
        }
        if (!$returnData) {
            $transformer = $this->getTransformer();
            $returnData  = $transformer ? fractal($data, $transformer)->respond() : $data;
        }
        return $alert ? res()->success('common.process_succeeded', $returnData) : $returnData;
    }

    public function handleQueryMethods(&$query, $method = 'index')
    {
        $camel      = ucfirst($method);
        $methodName = "to{$camel}Query";
        if (!$this->hasMethod($methodName)) {
            return null;
        }
        return $this->$methodName($query);
    }

    public function handleRequestFilters(&$query, $request)
    {
        $filters = $this->getFilters();

        if ($filters && count($filters) > 0) {
            foreach ($filters as $key => $callback) {
                if (!$request->has($key)) {
                    continue;
                }
                $requestValue = $request->$key;
                if (is_callable($callback)) {
                    switch ($requestValue) {
                        case "true":
                            $requestValue = true;
                            break;
                        case "false":
                            $requestValue = false;
                            break;
                        case "null":
                            $requestValue = null;
                            break;
                    }
                    $callback($query, $requestValue);
                    continue;
                }
                $query->where($key, $requestValue);
            }
        }
    }

    public function index()
    {
        $request       = $this->crudRequest('index');
        $requestInputs = ($request instanceof FormRequest) ? $request->validated() : $request->all();
        $sortByArray   = $this->getSortBy();
        $with          = $this->getWith();
        $query         = $this->getModel()
            ->when($with && count($with) > 0, function ($q) use ($with) {
                $q->with($with);
            })
            ->when($sortByArray != null && count($sortByArray) > 0, function ($q) use ($sortByArray) {
                foreach ($sortByArray as $key => $value) {
                    $q->orderBy($key, $value);
                }
            });

        $this->handleQueryMethods($query);
        $this->handleRequestFilters($query, $request);
        $paginator = $query->paginate($this->paginate_per_page ?? 15);
        if (($appends = $this->getAppends()) !== null && count($appends) > 0) {
            $paginator->getCollection()->each(fn($item) => $item->append($appends));
        }
        return $this->buildResponse($paginator, true, false);
    }

    public function store()
    {
        $request       = $this->crudRequest('store');
        $requestInputs = ($request instanceof FormRequest) ? $request->validated() : $request->all();
        $query         = $this->getModel()->query();
        $this->handleQueryMethods($query, 'store');
        $model = $query->create(
            $this->handleTranslatableAttributes($requestInputs, true)
        );
        $this->handleRequestMedia($request, $model);
        $this->handleRequestRelationships($request, $model);
        $model->append($this->getAppends());
        $model->refresh();
        return $this->buildResponse($model);
    }

    public function show()
    {
        $request       = $this->crudRequest('show');
        $requestInputs = ($request instanceof FormRequest) ? $request->validated() : $request->all();
        $pk            = $this->getPrimaryKey();
        $id            = request()->route($pk);
        $query         = $this->getModel()->query();
        $this->handleQueryMethods($query, 'show');
        $model = $query->where($pk, $id)->firstOrFail();
        $model->load($this->getWith());
        $model->append($this->getAppends());
        return $this->buildResponse($model, paginate:false);
    }

    public function update()
    {
        $request       = $this->crudRequest('update');
        $requestInputs = ($request instanceof FormRequest) ? $request->validated() : $request->all();
        $pk            = $this->getPrimaryKey();
        $id            = request()->route($pk);
        $query         = $this->getModel()->query();
        $this->handleQueryMethods($query, 'update');
        $model = $query->where($pk, $id)->firstOrFail();
        $model->update($this->handleTranslatableAttributes($requestInputs));
        $this->handleRequestMedia($request, $model);
        $this->handleRequestRelationships($request, $model);
        $model->append($this->getAppends());
        $model->refresh();
        return $this->buildResponse($model);
    }

    public function destroy()
    {
        $request       = $this->crudRequest('delete');
        $requestInputs = ($request instanceof FormRequest) ? $request->validated() : $request->all();
        $pk            = $this->getPrimaryKey();
        $id            = request()->route($pk);
        $query         = $this->getModel()->query();
        $this->handleQueryMethods($query, 'delete');
        $model = $query->where($pk, $id)->first();
        if ($model) {
            $model->delete();
        }
        return res()->success();
    }
}
