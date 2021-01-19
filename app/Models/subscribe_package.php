<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscribe_package extends Model
{
    use HasFactory;
    protected $table = 'subscribe_packages';
    protected $fillable = [
        'currency_name',
        'description',
        'description_ar',
        'period',
        'price',
    ];

}
