<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartImg extends Model
{
    use HasFactory;

    protected $table    = 'part_imgs';
    protected $fillable=[
        'part_id',
        'img_id',
    ];
}
