<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table    = 'cities';
    protected $fillable=[
        'title',
        'title_ar',
        'country_id',
        'governorate_id',
    ];
    use HasFactory;
}
