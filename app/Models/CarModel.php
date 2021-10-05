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
    ];

    public function maker(){
        return $this->belongsTo(CarMaker::class,'CarMaker_id','id');
    }
    public static function rules($request)
    {
        $rules = [
            'name'             => 'required|string|max:255',
            'CarMaker_id'      => 'required|exists:car_makers,id'
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
