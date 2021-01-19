<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarManufacture extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table    = 'car_manufactures';
    protected $fillable=[
        'name',
        'name_ar',
    ];

}
