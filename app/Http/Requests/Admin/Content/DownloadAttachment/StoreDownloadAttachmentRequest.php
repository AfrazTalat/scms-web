<?php

namespace App\Http\Requests\Admin\Content\DownloadAttachment;

use Illuminate\Foundation\Http\FormRequest;

class StoreDownloadAttachmentRequest extends FormRequest
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
            'file'                       => 'required|file|max:20480',
            'visible'                    => 'required|boolean',
            'translations'               => 'required',
            'translations.*.title'       => 'required|string|max:56',
            'translations.*.description' => 'nullable|string|max:4000',
        ];
    }
}
