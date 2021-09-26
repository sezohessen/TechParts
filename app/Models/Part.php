<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    // Make a new const value
    const base = '/img/PartImgs/';
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

    public static function rules($request,$id=NULL)
    {
        $rules = [
            'name'                     => 'nullable|max:255',
            'name_ar'                  => 'required|max:255',
            'desc'                     => 'nullable|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255|',
            'part_number'              => 'nullable|string',
            'price'                    => 'nullable|min:1|integer',
            'in_stock'                 => 'nullable|min:0|integer',
            'car_id'                   => 'required|exists:cars,id',
            'user_id'                  => 'required|exists:users,id'
        ];
        if($id){
            $rules['part_img.*']        = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';//Validate all
            $rules['part_img_new.*']    = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
    public static function credentials($request,$edit = NULL)
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
        return $credentials;
        if($edit){
            unset($credentials['user_id']);
        }
        if($request->file('part_img')){

        }
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
