<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $table    = 'car_models';
    protected $fillable=[
        'name',
        'CarMaker_id',
        'active'
    ];

    public static function rules($request)
    {
        $rules = [
            'name'             => 'required|string|max:255',
            'CarMaker_id'      => 'required'
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'name'              => $request->name,
            'CarMaker_id'       => $request->CarMaker_id,
        ];

        return $credentials;
    }


}
