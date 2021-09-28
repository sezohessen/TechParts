<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends Model
{
    const avatarBase     = '/img/avatar/';
    public const backgroundBase = '/img/background/';
    use HasFactory;
    protected $table    = 'sellers';
    protected $fillable=[
        'user_id',
        'bg ',
        'avatar',
        'desc',
        'desc_ar',
        'governorate_id',
        'city_id',
        'lat',
        'long',
        'street',
        'facebook',
        'instagram',
        'file',
    ];
    public static function rules($request,$id=NULL)
    {
        $rules = [
            'desc'                     => 'required|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255|',
            'bg'                       => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'avatar'                   => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'governorate_id'           => 'required|integer|exists:governorates,id',
            'city_id'                  => 'required|integer|exists:cities,id',
            'lat'                      => 'required',
            'long'                     => 'required',
            'street'                   => 'required|min:3|max:100',
            'facebook'                 => 'nullable',
            'instagram'                => 'nullable',
            // 'file'                     => 'nullable|max:10000|mimes:doc,docx,pdf',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'desc'              => $request->desc,
            'desc_ar'           => $request->desc_ar,
            'bg'                => $request->background,
            'avatar'            => $request->avatar,
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
    public function background(){
        return $this->belongsTo(Image::class,'bg','id');
    }
    public function sellerAvatar(){
        return $this->belongsTo(Image::class,'avatar','id');
    }
}
