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
        "active"
    ];

    public static function rules($request)
    {
        $rules = [
            'title'         => 'required|string|max:255',
            'title_ar'          => 'required|string|max:255',
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
            'active'         => 1
        ];

        return $credentials;
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class,'governorate_id','id');
    }

}
