<?php

namespace App\Http\Requests\Api\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartOrderRequest extends FormRequest
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
            'first_name'   => 'required|string|max:56',
            'last_name'    => 'required|string|max:56',
            'company_name' => 'nullable|string|max:56',
            'country_code' => 'required|string|max:2',
            'address'      => 'required|string|max:190',
            'address2'     => 'nullable|string|max:190',
            'city'         => 'required|string|max:56',
            'area'         => 'required|string|max:56',
            'zip_code'     => 'nullable|string|max:56',
            'phone_number' => 'required|string|max:56',
            'email'        => 'nullable|string|max:190',
            'notes'        => 'nullable|string|max:2000',
        ];
    }
}
