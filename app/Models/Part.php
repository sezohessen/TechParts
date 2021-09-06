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
    public static function rules($request,$id=NULL)
    {
        $rules = [
            'name'                     => 'required|max:255',
            'name_ar'                  => 'required|max:255',
            'desc'                     => 'required|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255|',
            'part_number'              => 'required|max:255|integer',
            'price'                    => 'required|min:1|integer',
            'in_stock'                 => 'required|min:1|integer',
            'part_img'                 => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'car_id'                   => 'required|',

        ];
        if($id){
            $rules['part_img'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
    public static function credentials($request,$img_id = NULL)
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
            'user_id'           => Auth()->user()->id
        ];
        return $credentials;
    }
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
