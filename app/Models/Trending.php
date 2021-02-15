<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trending extends Model
{
    use HasFactory;
    protected $table    = 'trendings';
    protected $dates    = ['day'];
    protected $fillable=[
        'day',
    ];
    public static function  rules($request)
    {
        $rules = [
            'day'               =>  'required|date',
            'car_id'            =>  'required|array|min:1',
        ];
        return $rules;
    }
    public static function  credentials($request)
    {
        $credentials = [
            'day'            => date("Y-m-d", strtotime($request->day)) ,
        ];

        return $credentials;
    }

    public function trends()
    {
        return $this->belongsToMany(Car::class, 'trendings_cars', 'trend_id','car_id');
    }
    public static function StyleTrending($data)
    {
        $new_data=[];
        foreach($data as $item){
            $new_data[]="<span class='label label-primary label-inline mr-2'
            style='padding: 30px;
            width: 128px;'>".$item->maker->name."</span>";
        }


        return $new_data;
    }
    public function trend()
    {
        return $this->hasOne(Car::class,'id','car_id');
    }
}
