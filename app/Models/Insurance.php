<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public static function  rules($request,$id = NULL, $create = null)
    {
        $rules = [
            'name'          => 'required|string|max:255',
            'name_ar'       => 'required|string|max:255',
            'logo'          => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'user_id'       => 'required'
        ];
        if($id == 'Insurance'){//For update in Dashborad
            $rules['logo'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }elseif($id){//For update in Insurance Dashboard
            $rules['logo'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
            unset($rules['user_id']);
        }
        if ($create) {
            $rules['logo'] = 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
    public static function  credentials($request,$id = NULL,$img_id = NULL)
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
            if($id){
                $Image_id = self::file($request->file('logo'),$img_id);
            }else{
                $Image_id = self::file($request->file('logo'));
            }
            $credentials['img_id'] = $Image_id;
        }else{
            if($id){
                $credentials['img_id'] = $img_id;
            }
        }
        return $credentials;
    }
    public static function file($file,$id = NULL)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/insurance/';
        $file->move($destinationPath, $fileName);
        if($id){//For update
            $Image = Image::find($id);
            //Delete Old image
            try {
                $file_old = $destinationPath.$Image->name;
                unlink($file_old);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            //Update new image
            $Image->name = $fileName;
            $Image->base = "/img/insurance/";
            $Image->save();
            return $Image->id;
        }else{
            $Image = Image::create(['name'=> $fileName, 'base' =>  '/img/insurance/']);
            return $Image->id;
        }
    }
    public function offers()
    {
        return $this->hasMany(Insurance_offer::class, 'insurance_id', 'id');
    }
    public function getNameByLangAttribute(){
        return Session::get('app_locale') == 'ar' ? $this->name_ar : $this->name;
    }
}
