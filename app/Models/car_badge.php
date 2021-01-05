<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car_badge extends Model
{
    use HasFactory;
    protected $table    = 'car_badges';
    protected $fillable=[
        'car_id',
        'badge_id',
    ];
}
