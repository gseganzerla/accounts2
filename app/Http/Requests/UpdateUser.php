<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
        $uuid = $this->segment(2);

        $rules = [
            'name' => ['required', 'min:3', 'max:30'],
            'email' => [
                'required', 'email', 'max:50',
                Rule::unique('users', 'uuid')->ignore($uuid)
            ],
            'password' => ['required', 'string', 'min:4', 'max:30'],
        ];

        if ($this->method() == 'PUT'){
            $rules['password'] = ['nullable', 'string', 'min:6', 'max:30'];
        }

        return $rules;
    }
}
