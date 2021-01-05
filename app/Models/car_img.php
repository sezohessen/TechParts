<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car_img extends Model
{
    use HasFactory;
    protected $table    = 'car_imgs';
    protected $fillable=[
        'car_id',
        'img_id',
    ];
}
