<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Country extends Model
{
    use HasFactory;
    protected $table    = 'countries';
    protected $fillable=[
        'name',
        'name_ar',
        'code',
        'country_phone',
        'active'
    ];

    public function governorates() {
        return $this->hasMany(Governorate::class);
    }

    public static function rules($request)
    {
        $rules = [
            'name_ar'        => 'required|string|max:255',
            'name'           => 'required|string|max:255',
            'code'           => 'required|string|max:50',
            'country_phone'  => 'required|string|max:50',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'name_ar'           =>  $request->name_ar,
            'name'              =>  $request->name,
            'code'              =>  $request->code,
            'country_phone'     =>  $request->country_phone,
            'active'            => 1
        ];
        return $credentials;
    }
}
