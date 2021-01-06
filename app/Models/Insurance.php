<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $table    = 'insurances';
    protected $fillable=[
        'name',
        'name_ar',
        'img_id',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function img(){
        return $this->belongsTo(Image::class,'img_id','id');
    }
    public static function rules($request,$id = NULL)
    {
        $rules = [
            'name'          => 'required|string|max:255',
            'name_ar'       => 'required|string|max:255',
            'logo'          => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'user_id'       => 'required'
        ];
        if($id){
            unset($rules['user_id']);
        }
        return $rules;
    }
    public static function credentials($request,$id = NULL)
    {
        $credentials = [
            'name_ar'           =>  $request->name_ar,
            'name'              =>  $request->name,
        ];
        if($id){
            $credentials['user_id'] = $id;
        }else{
            $credentials['user_id'] = $request->user_id;
        }
        if($request->file('logo')){
            $Image_id = self::file($request->file('logo'));
            $credentials['img_id'] = $Image_id;
        }
        return $credentials;
    }
    public static function file($file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/insurance/';
        $file->move($destinationPath, $fileName);
        $Image = Image::create(['name' => $fileName]);
        return $Image->id;
    }
}
