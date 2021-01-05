<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privacy_Policy extends Model
{
    use HasFactory;
    protected $table = 'privacy__policies';
    protected $fillable = [
        'description',
        'description_ar'
    ];
}
