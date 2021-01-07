<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyCar extends Model
{
    use HasFactory;
    protected $table    = 'agency_cars';
    protected $fillable=[
        'car_id',
        'agent_id',
    ];
}
