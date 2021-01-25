<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyMaintenanceList extends Model
{
    use HasFactory;
    protected $table    = 'my_maintenance_lists';
    protected $fillable=[
        'CarMaker_id',
        'CarModel_id',
        'date_next',
        'user_id'
    ];
}
