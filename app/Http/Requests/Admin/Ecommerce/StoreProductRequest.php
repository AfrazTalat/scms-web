<?php

namespace App\Http\Requests\Admin\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categories'                 => 'nullable|array|exists:categories,id',
            'brand_id'                   => 'nullable|numeric|exists:brands,id',
            'price'                      => 'required|numeric',
            'stock_qty'                  => 'required|numeric',
            'youtube_video'              => 'nullable|string',
            'hidden'                     => 'nullable|boolean',
            'featured'                   => 'nullable|boolean',
            'translations'               => 'required',
            'translations.*.name'        => 'required|string|max:56',
            'translations.*.subtitle'    => 'nullable|string|max:256',
            'translations.*.description' => 'nullable|string|max:4000',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'categories'   => $this->category ? [$this->category] : [],
            'translations' => is_string($this->translations) ? json_decode($this->translations, true) : $this->translations,
        ]);
    }
}
