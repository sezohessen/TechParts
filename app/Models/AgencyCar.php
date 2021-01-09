<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyCar extends Model
{
    use HasFactory;
    protected $table    = 'agency_cars';
    protected $fillable=[
        'CarMaker_id',
        'agent_id',
    ];
    public static function rules($request)
    {
        $rules = [
            'CarMaker_id'            => "required|array",
            'CarMaker_id.*'          => "required|distinct",
            'agent_id'               => 'nullable',
        ];
        return $rules;
    }
    public static function credentials($CarMaker_id,$agent_id)
    {
        $credentials = [
            'CarMaker_id'          =>  $CarMaker_id,
            'agent_id'             =>  $agent_id,
        ];
        
        return $credentials;
    }
}
