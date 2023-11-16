<?php

namespace App\Http\Requests\Admin\Common\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'is_enabled'                 => 'required|boolean',
            'featured'                   => 'required|boolean',
            'parent_id'                  => 'nullable|numeric',
            'translations'               => 'required',
            'translations.*.name'        => 'required|string|max:56',
            'translations.*.description' => 'nullable|string|max:4000',
            // 'categories'  => 'nullable|array|exists:categories,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'translations' => is_string($this->translations) ? json_decode($this->translations, true) : $this->translations,
        ]);
    }
}
