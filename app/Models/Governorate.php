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
        'country_id'
    ];
    public function country() {
        return $this->belongsTo(Country::class);
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
        ];

        return $credentials;
    }
}
