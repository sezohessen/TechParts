<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoteCar extends Model
{
    use HasFactory;
    protected $table    = 'promote_cars';
    protected $fillable=[
        'user_id',
        'car_id',
        "subscribe_package_id",
        "price",
        "weaccept_order_id"
    ];
 


}
