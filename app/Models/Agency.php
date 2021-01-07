<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    protected $table    = 'agencies';
    protected $fillable=[
        'name',
        'name_ar',
        'description',
        'description_ar',
        'show_in_home',
        'car_show_rooms',
        'center_type',
        'description_ar',
        'lat',
        'long',
        'car_status',
        'payment_method',
        'img_id',
        'country_id',
        'governorate_id',
        'city_id',
    ];
}
