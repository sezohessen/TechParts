<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarBody extends Model
{

    use HasFactory;
    protected $table    = 'car_bodies';
    protected $fillable=[
        'name',
        'logo_id',
        "active"
    ];
    public function logo()
    {
        return $this->belongsTo(Image::class);
    }

    public static function rules($request,$id = NULL)
    {
        $rules = [
            'name'             => 'required|string|max:255',
            'logo'             => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ];
        if($id){
            $rules['logo'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
    public static function credentials($request,$img_id = NULL)
    {
        $credentials = [
            'name'              => $request->name,
        ];
        if($request->file('logo')){
            if($img_id){
                $Image_id = self::file($request->file('logo'),$img_id);
            }else {
                $Image_id = self::file($request->file('logo'));
            }
            $credentials['logo_id'] = $Image_id;
        }
        return $credentials;
    }
    public static function file($file,$id = NULL)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/CarBodies/';
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
            $Image->base = "/img/CarBodies/";
            $Image->save();
            return $Image->id;
        }else{
            $Image = Image::create(['name'=> $fileName, 'base' =>  '/img/CarBodies/']);
            return $Image->id;
        }
    }

}
