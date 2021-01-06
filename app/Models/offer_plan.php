<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer_plan extends Model
{
    use HasFactory;
    protected $table    = 'offer_plans';
    protected $fillable=[
        'title',
        'title_ar',
        'description',
        'description_ar',
        'price',
        'offer_id',
        'insurance_id',
    ];
    public function offer_plan(){
        return $this->belongsTo(offer_plan::class,"offer_id","id");
    }
    public function insurance(){
        return $this->belongsTo(Insurance::class,"insurance_id","id");
    }
    public static function rules($request,$id = NULL)
    {
        $rules = [
            'name'              => 'required|string|max:255',
            'name_ar'           => 'required|string|max:255',
            'insurance_id'      => 'required',
            'offer_id'          => 'required',
            'price'             => 'required|numeric|digits_between:1,10',
            'description'       => 'required|min:3|max:1000',
            'description_ar'    => 'required|min:3|max:1000',
        ];
        if($id){
            unset($rules['insurance_id']);
        }
        return $rules;
    }
    public static function credentials($request,$id = NULL)
    {
        $credentials = [
            'title'           =>  $request->name,
            'title_ar'        =>  $request->name_ar,
            'offer_id'        =>  $request->offer_id,
            'price'           =>  $request->price,
            'description'     =>  $request->description,
            'description_ar'  =>  $request->description_ar,
        ];
        if($id){
            $credentials['insurance_id'] = $id;
        }else{
            $credentials['insurance_id'] = $request->insurance_id;
        }
        return $credentials;
    }
}
