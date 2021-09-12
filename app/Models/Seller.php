<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $table    = 'sellers';
    protected $fillable=[
        'user_id',
        'desc',
        'desc_ar',
        'governorate_id',
        'city_id',
        'lat',
        'long',
        'street',
        'facebook',
        'instagram',
    ];
    public static function rules($request,$id=NULL)
    {
        $rules = [
            'desc'                     => 'required|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255|',
            'governorate_id'           => 'required|integer|exists:governorates,id',
            'city_id'                  => 'required|integer|exists:cities,id',
            'lat'                      => 'required',
            'long'                     => 'required',
            'street'                   => 'required|min:5|max:100',
            'facebook'                 => 'nullable',
            'instagram'                => 'nullable',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'desc'              => $request->desc,
            'desc_ar'           => $request->desc_ar,
            'governorate_id'    => $request->governorate_id,
            'city_id'           => $request->city_id,
            'lat'               => $request->lat,
            'long'              => $request->long,
            'street'            => $request->street,
            'facebook'          => $request->facebook,
            'instagram'         => $request->instagram,
        ];
        return $credentials;
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class,'governorate_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }

}