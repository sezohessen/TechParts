<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    
    protected $table    = 'cities';
    protected $fillable=[
        'title',
        'title_ar',
        'country_id',
        'governorate_id',
    ];

    public static function rules($request)
    {
        $rules = [
            'CityEnglish'         => 'required|string|max:255',
            'CityArabic'          => 'required|string|max:255',
            'country_id'          => 'required',
            'governorate'         => 'required'
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'title'         =>  $request->CityEnglish,
            'title_ar'      =>  $request->CityArabic,
            'country_id'    =>  $request->country_id,
            'governorate_id'=>  $request->governorate,
        ];

        return $credentials;
    }
}
