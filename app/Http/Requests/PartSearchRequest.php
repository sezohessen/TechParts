<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartSearchRequest extends FormRequest
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
            'searchOpt'       => 'required',
            "search"          => "required_if:searchOpt,==,normal",
            "carBrand"        => "required_if:searchOpt,==,adv",
            'carType'         => 'nullable|integer',
            'carYear'         => 'nullable|integer',
            'carCapacity'     => 'nullable|integer',
            'carType'         => 'nullable|integer',
            'order'           => 'nullable|string',

        ];
    }
}
