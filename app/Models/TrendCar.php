<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendCar extends Model
{
    use HasFactory;
    protected $table    = 'trendings_cars';
    protected $fillable=[
        'car_id',
        'trend_id',
    ];
    public static function rules($request)
    {
        $rules = [
            'car_id'            => "required|array",
            'car_id.*'          => "required|distinct",
            'trend_id'          => 'nullable',
        ];
        return $rules;
    }
    public static function credentials($car_id,$trend_id)
    {
        $credentials = [
            'car_id'           =>  $car_id,
            'trend_id'         =>  $trend_id,
        ];

        return $credentials;
    }

}
