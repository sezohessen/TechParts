<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFav extends Model
{
    use HasFactory;
    protected $table    = 'users_favorite';
    protected $fillable=[
        'user_id',
        'part_id',
    ];


    public function partFav()
    {
      return $this->belongsTo(Part::class,'part_id','id');
    }
}
