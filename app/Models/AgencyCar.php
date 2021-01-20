<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyCar extends Model
{
    use HasFactory;
    protected $table    = 'agency_cars';
    protected $fillable=[
        'car_id',
        'agency_id',
    ];
    public static function rules($request)
    {
        $rules = [
            'agency_id'     => 'required',
        ];
        return $rules;
    }
    public static function credentials($request,$car_id)
    {
        $credentials = [
            'car_id'        =>  $car_id,
            'agency_id'     =>  $request->agency_id,
        ];

        return $credentials;
    }
}
