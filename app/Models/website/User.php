<?php

namespace App\Models\website;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $hashPassword = Hash::make($request->password);
        $credentials = [
            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'Phone'                 => $request->Phone,
            'password'              => $hashPassword,

        ];
        return $credentials;
    }
}
