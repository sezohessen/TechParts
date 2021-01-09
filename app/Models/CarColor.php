<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarColor extends Model
{
    use HasFactory;
    protected $table    = 'car_colors';
    protected $fillable=[
        'code',
    ];
    public static function rules($request)
    {
        $rules = [
            'code'             => 'required|string|max:255',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'code'              => $request->code,
        ];
        return $credentials;
    }


}
