<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:2|max:56',
            'last_name'  => 'required|string|min:2|max:56',
            'email'      => 'required|email|max:256|unique:users,email',
            'password'   => 'required|string|min:8',
            'roles'      => 'required|array|exists:roles,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'roles' => [$this->role],
        ]);
    }
}
