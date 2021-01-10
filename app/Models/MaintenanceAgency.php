<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceAgency extends Model
{
    use HasFactory;
    protected $table    = 'maintenance_agencies';
    protected $fillable=[
        'maintenance_id',
        'agent_id',
    ];
}
