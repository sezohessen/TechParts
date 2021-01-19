<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencySpecialties extends Model
{
    use HasFactory;
    protected $table    = 'agency_specialties';
    protected $fillable=[
        'specialty_id',
        'agency_id',
    ];
    public static function credentials($CarMaker_id,$agent_id)
    {
        $credentials = [
            'specialty_id'          =>  $CarMaker_id,
            'agency_id'             =>  $agent_id,
        ];

        return $credentials;
    }
}
