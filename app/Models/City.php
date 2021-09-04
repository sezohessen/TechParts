<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table    = 'cities';
    protected $fillable=[
        'title',
        'title_ar',
        'governorate_id',
    ];

    public static function rules($request)
    {
        $rules = [
            'title'         => 'required|string|max:255',
            'title_ar'          => 'required|string|max:255',
            'governorate_id'         => 'required'
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'title'         =>  $request->title,
            'title_ar'      =>  $request->title_ar,
            'governorate_id'=>  $request->governorate_id,
        ];

        return $credentials;
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class,'governorate_id','id');
    }

}
