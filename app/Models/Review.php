<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table    = 'reviews';
    protected $fillable=[
        'title',
        'review',
        'rating',
        'user_id',
        'part_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
