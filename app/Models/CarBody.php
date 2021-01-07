<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBody extends Model
{

    use HasFactory;
    protected $table    = 'car_bodies';
    protected $fillable=[
        'name',
        'logo_id',
    ];

}
