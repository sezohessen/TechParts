<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavAgency extends Model
{
    use HasFactory;
    protected $table    = 'user_fav_agencies';
    protected $fillable=[
        'agency_id',
        'user_id',
    ];
}
