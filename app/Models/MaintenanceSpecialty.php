<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceSpecialty extends Model
{
    use HasFactory;
    protected $table    = 'maintenance_specialties';
    protected $fillable=[
        'name',
        'name_ar',
        'active',
    ];
}
