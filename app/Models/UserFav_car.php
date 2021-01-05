<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFav_car extends Model
{
    use HasFactory;
    protected $table    = 'user_fav_cars';
    protected $fillable=[
        'car_id',
        'user_id',
    ];
}
