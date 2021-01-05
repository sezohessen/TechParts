<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car_feature extends Model
{
    use HasFactory;
    protected $table    = 'car_features';
    protected $fillable=[
        'car_id',
        'feature_id',
    ];
}
