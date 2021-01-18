<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyReview extends Model
{
    use HasFactory;
    protected $table    = 'agency_reviews';
    protected $fillable=[
        'rate',
        'price',
        'review',
        'agency_id',
        'user_id',
    ];
}
