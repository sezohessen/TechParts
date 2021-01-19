<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car_deposit extends Model
{
    use HasFactory;
    protected $table    = 'car_deposits';
    protected $fillable=[
        'user_id',
        'car_id',
        'price',
        'weaccept_order_id'
    ];

}
