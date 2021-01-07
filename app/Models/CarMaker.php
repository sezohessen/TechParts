<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMaker extends Model
{
    use HasFactory;
    protected $table    = 'car_makers';
    protected $fillable=[
        'name',
        'logo_id',
        'active'
    ];

}
