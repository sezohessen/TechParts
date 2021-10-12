<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerRating extends Model
{
     use HasFactory;
    const HasReview = 1;
    const HasNotReview = 0;
    const NotLogin = 2;
    protected $table    = 'sellers_rating';
    protected $fillable=[
        'review',
        'rating',
        'user_id',
        'seller_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
