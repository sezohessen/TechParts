<?php

namespace App\Models;

use App\Rules\periodValidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class subscribe_package extends Model
{
    use HasFactory;
    protected $table = 'subscribe_packages';
    protected $fillable = [
        'currency_name',
        'description',
        'description_ar',
        'period',
        'price',
    ];
    public static function  rules($request)
    {
        $rules = [
            'currency_name'          => 'required|string|max:255',
            'description'            => 'required|string|max:255',
            'description_ar'         => 'required|string|max:255',
            'period'                 => 'required|integer',
            'price'                  => 'required|integer'
        ];
        return $rules;
    }
    public static function  credentials($request)
    {
        $credentials = [
            'currency_name'          => $request->currency_name,
            'description'            => $request->description,
            'description_ar'         => $request->description_ar,
            'period'                 => $request->period,
            'price'                  => $request->price
        ];

        return $credentials;
    }
}
