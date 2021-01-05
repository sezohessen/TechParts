<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;
    protected $table    = 'governorates';
    protected $fillable=[
        'title',
        'title_ar',
        'country_id',
        "active"
    ];
    public function country() {
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function cities() {
        return $this->hasMany(City::class);
    }
    public static function rules($request)
    {
        $rules = [
            'GovernorateEnglish'        => 'required|string|max:255',
            'GovernorateArabic'         => 'required|string|max:255',
            'country_id'                => 'required',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'title'             =>  $request->GovernorateEnglish,
            'title_ar'          =>  $request->GovernorateArabic,
            'country_id'        =>  $request->country_id,
            'active'            => 1
        ];

        return $credentials;
    }
}
