<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarYear extends Model
{
    use HasFactory;
    protected $table    = 'car_years';
    protected $fillable=[
        'year',
    ];
}

