<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $table    = 'parts';
    protected $fillable=[
        'name',
        'name_ar',
        'desc',
        'desc_ar',
        'part_number',
        'price',
        'in_stock',
        'active',
        'views',
        'car_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function car()
    {
        return $this->belongsTo(Car::class,"car_id","id");
    }
    public function images()
    {
        return $this->hasMany(PartImg::class,"part_id","id");
    }

}
