<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyContact extends Model
{
    use HasFactory;
    protected $table    = 'agency_contacts';
    protected $fillable=[
        'facebook',
        'whatsapp',
        'instagram',
        'messenger',
        'agent_id'
    ];
    public static function rules($request)
    {
        $rules = [
            'facebook'              => 'nullable',
            'whatsapp'              => 'nullable',
            'instagram'             => 'nullable',
            'messenger'             => 'nullable',
        ];
        return $rules;
    }
    public static function credentials($request,$agent_id)
    {
        $credentials = [
            'agent_id'               =>  $agent_id,
            'facebook'               =>  $request->facebook,
            'whatsapp'               =>  $request->whatsapp,
            'instagram'              =>  $request->instagram,
            'messenger'              =>  $request->messenger,
        ];
        return $credentials;
    }
}
