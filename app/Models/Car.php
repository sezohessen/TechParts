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
            'CarMaker_id'           => 'required|integer',
            'CarModel_id'           => 'required|integer',
            'CarYear_id'            => 'required|integer',
            'CarCapacity_id'        => 'required|integer',
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

    public function make()
    {
        return $this->belongsTo(CarMaker::class,"CarMaker_id","id");
    }
    public function year()
    {
        return $this->belongsTo(CarYear::class,"CarYear_id","id");
    }
    public function model()
    {
        return $this->belongsTo(CarModel::class,"CarModel_id","id")->where('active','=', 1);
    }
    public function maker()
    {
        return $this->belongsTo(CarMaker::class,"CarMaker_id","id")->where('active','=', 1);
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
