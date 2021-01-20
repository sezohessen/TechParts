<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoteCar extends Model
{
    use HasFactory;
    protected $table    = 'promote_cars';
    protected $fillable=[
        'user_id',
        'car_id',
        "subscribe_package_id",
        "price",
        "weaccept_order_id"
    ];
    public function car()
    {
        return $this->belongsTo(Car::class,"car_id","id")
        ->where('status','=', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function subscribe_package()
    {
        return $this->belongsTo(subscribe_package::class,"subscribe_package_id","id");
    }
    public static function  rules($request)
    {
        $rules = [
            'car_id'               => 'required|integer',
            'subscribe_package_id' => 'required|integer',
            'price'                => 'required|integer',
            'weaccept_order_id'    => 'required|string',
        ];
        return $rules;
    }
    public static function  credentials($request)
    {
        $credentials = [
            'car_id'               => $request->car_id,
            'subscribe_package_id' => $request->subscribe_package_id,
            'price'                => $request->price,
            'weaccept_order_id'    => $request->weaccept_order_id,
            'user_id'              => Auth()->user()->id,
        ];

        return $credentials;
    }


}
