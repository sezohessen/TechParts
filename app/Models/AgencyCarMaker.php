<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyCarMaker extends Model
{
    use HasFactory;
    protected $table    = 'agency_car_makers';
    protected $fillable=[
        'CarMaker_id',
        'agency_id',
    ];
    public static function rules($request)
    {
        $rules = [
            'CarMaker_id'            => "required|array",
            'CarMaker_id.*'          => "required|distinct",
            'agency_id'              => 'nullable',
        ];
        return $rules;
    }
    public static function credentials($CarMaker_id,$agent_id)
    {
        $credentials = [
            'CarMaker_id'          =>  $CarMaker_id,
            'agency_id'            =>  $agent_id,
        ];

        return $credentials;
    }
}
