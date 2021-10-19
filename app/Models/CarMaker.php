<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarMaker extends Model
{
    const base = '/img/CarMakers/';
    use HasFactory;
    protected $table    = 'car_makers';
    protected $fillable=[
        'name',
        'logo_id',
        'class_id',
    ];
    public function logo()
    {
        return $this->belongsTo(Image::class);
    }
    public function Classification(){
        return $this->belongsTo(CarClassification::class,'class_id','id');
    }
    public static function rules($request,$id=NULL)
    {
        $rules = [
            'name'             => 'required|string|max:255',
            'logo'             => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'class_id'         => 'required|integer|exists:car_classifications,id'
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
            'class_id'          => $request->class_id,
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
        $destinationPath = public_path() . '/img/CarMakers/';
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
            $Image->base = "/img/CarMakers/";
            $Image->save();
            return $Image->id;
        }else{
            $Image = Image::create(['name'=> $fileName, 'base' =>  '/img/CarMakers/']);
            return $Image->id;
        }
    }
}
