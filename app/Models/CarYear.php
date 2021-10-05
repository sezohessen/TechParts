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
        'CarModel_id'
    ];
    public static function rules($request)
    {
        $rules = [
            'year'             => 'required|integer|digits_between:4,4',
            'CarModel_id'      => 'required|integer|exists:car_models,id',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'year'              => $request->year,
            'CarModel_id'              => $request->CarModel_id,
        ];
        return $credentials;
    }
    public function model(){
        return $this->belongsTo(CarModel::class,'CarModel_id','id');
    }

}

