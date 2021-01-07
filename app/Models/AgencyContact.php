<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyContact extends Model
{
    use HasFactory;
    protected $table    = 'agency_contacts';
    protected $fillable=[
        'facebook',
        'whatsapp',
        'instagram',
        'messenger',
    ];
}
