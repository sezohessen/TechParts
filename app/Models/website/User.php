<?php

namespace App\Models\website;

use App\Models\Part;
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

}
