<?php

namespace App\Models\website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table    = 'contact_us';
    protected $fillable=[
        'email',
        'phone',
        'message',
    ];
    public static function rules()
    {
        $rules = [
            'email'        => 'required|email:rfc,dns',
            'phone'        => 'required|digits:11|',
            'message'      => 'required|min:5|max:255',

        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'email'              => $request->email,
            'phone'              => $request->phone,
            'message'            => $request->message,
        ];
        return $credentials;
    }
}
