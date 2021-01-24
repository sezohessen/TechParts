<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $table    = 'alerts';
    protected $fillable=[
        'user_id',
        'car_id',
        'status',
    ];
}
