<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table    = 'governorates';
    protected $fillable=[
        'title',
        'title_ar',
        'country_id'
    ];
    use HasFactory;
}
