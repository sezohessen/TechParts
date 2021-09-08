<?php

namespace App\Models\website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table    = 'users';
    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'phone',
        'password',
        'phone',
        'whats_app',

    ];
    public static function rules()
    {
        $rules = [
            'first_name'       => 'required|min:5|max:15',
            'last_name'        => 'required|min:5|max:15|',
            'Phone'            => 'required|digits:11|',
            // 'password'         => 'nullable|',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'Phone'                 => $request->Phone,
            // 'password'              => $request->password,

        ];
        return $credentials;
    }
}
