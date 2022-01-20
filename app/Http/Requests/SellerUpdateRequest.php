<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerUpdateRequest extends FormRequest
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
            'desc'                     => 'nullable|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255',
            'bg'                       => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'avatar'                   => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'governorate_id'           => 'required|integer|exists:governorates,id',
            'city_id'                  => 'required|integer|exists:cities,id',
            'lat'                      => 'required',
            'long'                     => 'required',
            'street'                   => 'required|min:3|max:100',
            'facebook'                 => 'nullable',
            'instagram'                => 'nullable',
            'file'                     => 'nullable|max:4096|mimes:doc,dot,docm,docx,dotx,pdf,xlxs,xls,xlsm,xlsb,xltx,txt,rar,zip',
            'specialty_id.*'           => 'required|exists:car_makers,id',
            'brand'                    => 'required'
        ];
    }
}
