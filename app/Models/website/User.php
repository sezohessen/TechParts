<?php

namespace App\Models\website;

use Illuminate\Support\Facades\Auth;
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

    // public static function rules()
    // {
    //     $rules = [
    //         'first_name'       => 'required|min:5|max:15',
    //         'last_name'        => 'required|min:5|max:15|',
    //         'phone'            => 'required|digits:11|',
    //         'email'            => 'required||unique:users,email,'.Auth::user()->email,
    //         'password_confirm' => 'nullable|same:password'
    //     ];
    //     return $rules;
    // }

    // public static function credentials($request)
    // {
    //     $hashPassword = Hash::make($request->password);
    //     $credentials = [
    //         'first_name'            => $request->first_name,
    //         'last_name'             => $request->last_name,
    //         'phone'                 => $request->phone,
    //         'password'              => $hashPassword,
    //     ];
    //     return $credentials;
    // }
}
