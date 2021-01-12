<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankContact extends Model
{
    use HasFactory;
    protected $table    = 'bank_contacts';
    protected $fillable=[
        'whatsapp',
        'email',
        'phone',
        'bank_id',
    ];
    public static function rules($request)
    {
        $rules = [
            'whatsapp'              => 'nullable',
            'phone'                 => 'nullable',
            'email'                 => 'email|nullable',
        ];
        return $rules;
    }
    public static function credentials($request,$bank_id)
    {
        $credentials = [
            'bank_id'               =>  $bank_id,
            'whatsapp'              =>  $request->whatsapp,
            'phone'                 =>  $request->phone,
            'email'                 =>  $request->email,
        ];
        return $credentials;
    }
}
