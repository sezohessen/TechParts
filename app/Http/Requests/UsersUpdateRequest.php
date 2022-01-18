<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest
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
            'first_name'        => 'nullable|string|min:4|max:255',
            'last_name'         => 'nullable|string|min:4|max:255',
            'phone'             => 'nullable|string|digits:11|unique:users',
            'whats_app'         => 'nullable|string|digits:11|unique:users,whats_app',
            'password'          => 'nullable|string|min:8',
        ];
    }
}
