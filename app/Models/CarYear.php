<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarYear extends Model
{
    use HasFactory;
    protected $table    = 'car_years';
    protected $fillable=[
        'year',
    ];
    public static function rules($request)
    {
        $rules = [
            'year'             => 'required|numeric|digits_between:4,4',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'year'              => $request->year,
        ];
        return $credentials;
    }
}

