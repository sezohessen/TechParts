<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartRequest extends FormRequest
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
    const base = '/img/PartImgs/';
    const ImgSize = 2048;
    const ImgCount = 4;
    public function rules()
    {
        return [
            'name'                     => 'nullable|min:4|max:255',
            'name_ar'                  => 'required|min:4|max:255',
            'desc'                     => 'nullable|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255|',
            'part_number'              => 'nullable|string',
            'price'                    => 'nullable|min:1|max:1000000|integer',
            'in_stock'                 => 'nullable|min:0|max:1000000|integer',
            'CarMaker_id'              => 'required|integer|exists:car_makers,id',
            'CarModel_id'              => 'required|integer|exists:car_models,id',
            'CarYear_id'               => 'nullable|integer|exists:car_years,id',
            'CarCapacity_id'           => 'nullable|integer|exists:car_capacities,id',
            'part_img_one'             => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize,
            'part_img_two'             => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize,
            'part_img_three'           => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize,
            'part_img_four'            => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize
        ];
    }
}
