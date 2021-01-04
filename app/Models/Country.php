<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table    = 'countries';
    protected $fillable=[
        'name',
        'name_ar',
        'code',
        'country_phone'
    ];

    public function governorates() {
        return $this->hasMany(Governorate::class);
    }
    public static function rules($request)
    {
        $rules = [
            'CountryArabic'        => 'required|string|max:255',
            'CountryEnglish'       => 'required|string|max:255',
            'CountryCode'          => 'required|string|max:50',
            'country_phone'          => 'required|string|max:50',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'name_ar'           =>  $request->CountryArabic,
            'name'              =>  $request->CountryEnglish,
            'code'              =>  $request->CountryCode,
            'country_phone'              =>  $request->country_phone,
        ];
        return $credentials;
    }
}
