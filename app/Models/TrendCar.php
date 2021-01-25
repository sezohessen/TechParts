<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendCar extends Model
{
    use HasFactory;
    protected $table    = 'trendings_cars';
    protected $fillable=[
        'car_id',
        'trend_id',
    ];

}
