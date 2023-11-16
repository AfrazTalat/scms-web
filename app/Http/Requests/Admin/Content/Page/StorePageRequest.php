<?php

namespace App\Http\Requests\Admin\Content\Page;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
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
            'slug'                   => 'required|string|min:3|max:56',
            'visible'                => 'required|boolean',
            'translations'           => 'required',
            'translations.*.title'   => 'required|string|max:56',
            'translations.*.content' => 'nullable|string|max:4000',
        ];
    }
}
