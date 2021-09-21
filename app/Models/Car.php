<?php

namespace App\Models;

use Exception;
use App\Rules\periodValidate;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    
    use HasFactory;
    protected $table    = 'cars';
    protected $fillable=[
        'CarMaker_id',
        'CarModel_id',
        'CarYear_id',
        'CarCapacity_id',
        'user_id',
    ];
    public static function rules($request)
    {
        $rules = [
            'CarMaker_id'           => 'required|integer|exists:car_makers,id',
            'CarModel_id'           => 'required|integer|exists:car_models,id',
            'CarYear_id'            => 'required|integer|exists:car_years,id',
            'CarCapacity_id'        => 'required|integer|exists:car_capacities,id',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'CarMaker_id'           => $request->CarMaker_id,
            'CarModel_id'           => $request->CarModel_id,
            'CarYear_id'            => $request->CarYear_id,
            'CarCapacity_id'        => $request->CarCapacity_id,
            'user_id'               => Auth()->user()->id
        ];
        return $credentials;
    }
    public function model()
    {
        return $this->belongsTo(CarModel::class,"CarModel_id","id");
    }
    public function make()
    {
        return $this->belongsTo(CarMaker::class,"CarMaker_id","id");
    }
    public function year()
    {
        return $this->belongsTo(CarYear::class,"CarYear_id","id");
    }
    public function capacity()
    {
        return $this->belongsTo(CarCapacity::class,"CarCapacity_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
