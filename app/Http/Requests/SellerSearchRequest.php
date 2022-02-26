<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerSearchRequest extends FormRequest
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
            'governorate_id'    => 'required|integer',
            'city_id'           => 'nullable|integer',
            'brand_id'          => 'nullable|integer',
        ];
    }
}
