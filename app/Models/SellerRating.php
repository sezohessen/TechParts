<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerRating extends Model
{
    use HasFactory;
    protected $table    = 'sellers_rating ';
    protected $fillable=[
        'user_id',
        'seller_id',
    ];


}
