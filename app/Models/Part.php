<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    // Make a new const value
    const base = '/img/PartImgs/';
    const ImgSize = 2048;
    const ImgCount = 4;
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
    protected $appends = ['first_image'];

    public static function rules($request,$image = NULL,$InSellerDashboard = NULL)
    {
        $rules = [
            'name'                     => 'nullable|min:4|max:255',
            'name_ar'                  => 'required|min:4|max:255',
            'desc'                     => 'nullable|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255|',
            'part_number'              => 'nullable|string',
            'price'                    => 'nullable|min:1|max:1000000|integer',
            'in_stock'                 => 'nullable|min:0|max:1000000|integer',
            'car_id'                   => 'required|exists:cars,id',
            'user_id'                  => 'required|exists:users,id',
            'part_img_new.0'           => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize,
            'part_img_new.*'           => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize
        ];
        if($image){
            $rules['part_img.*']        = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize;//Validate all
            $rules['part_img_new.*']    = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize;
            $rules['part_img_new.0']    = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:'.self::ImgSize;
        }
        if($InSellerDashboard)unset($rules['user_id']);
        return $rules;
    }
    public static function credentials($request,$userID = NULL)
    {
        $credentials = [
            'name'              => $request->name,
            'name_ar'           => $request->name_ar,
            'desc'              => $request->desc,
            'desc_ar'           => $request->desc_ar,
            'part_number'       => $request->part_number,
            'price'             => $request->price,
            'in_stock'          => $request->in_stock,
            'car_id'            => $request->car_id,
            'user_id'           => $request->user_id,
        ];
        if($userID)$credentials['user_id'] = Auth()->user()->id;
        return $credentials;

    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function seller()
    {
        return $this->hasOne(Seller::class,'user_id','user_id');
    }
    public function car()
    {
        return $this->belongsTo(Car::class,"car_id","id");
    }
    public function images()
    {
        return $this->hasMany(PartImg::class,"part_id","id");
    }
    public function getFirstImageAttribute() {
        return $this->images->first();
    }

}
