<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStoreRequest extends FormRequest
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
            'first_name'        => 'required|string|min:4|max:255',
            'last_name'         => 'required|string|min:4|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'phone'             => 'nullable|string|digits:11|unique:users',
            'whats_app'         => 'nullable|string|digits:11|unique:users,whats_app',
            'password'          => 'required|string|min:8',
            'provider'          => 'required'
        ];
    }
}
