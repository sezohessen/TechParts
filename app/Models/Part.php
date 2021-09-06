<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $table    = 'parts';
    protected $fillable=[
        'name',
        'desc',
        'part_number',
        'price',
        'in_stock',
        'active',
        'views',
        'car_id',
        'user_id',
    ];
}
