<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance_offer extends Model
{
    use HasFactory;
    protected $table    = 'insurance_offers';
    protected $fillable=[
        'title',
        'title_ar',
        'description',
        'description_ar',
        'img_id',
        'insurance_id',
    ];
    public function insurance(){
        return $this->belongsTo(Insurance::class,"insurance_id","id");
    }
    public function img(){
        return $this->belongsTo(Image::class,'img_id','id');
    }
    public static function rules($request,$id = NULL)
    {
        $rules = [
            'name'              => 'required|string|max:255',
            'name_ar'           => 'required|string|max:255',
            'logo'              => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'insurance_id'      => 'required',
            'description'       => 'required|min:3|max:1000',
            'description_ar'    => 'required|min:3|max:1000',
        ];
        if($id){//For update
            unset($rules['insurance_id']);
        }
        return $rules;
    }
    public static function credentials($request,$id = NULL)
    {
        $credentials = [
            'title'           =>  $request->name,
            'title_ar'        =>  $request->name_ar,
            'description'     =>  $request->description,
            'description_ar'  =>  $request->description_ar,
        ];
        if($id){//For update
            $credentials['insurance_id'] = $id;
        }else{
            $credentials['insurance_id'] = $request->insurance_id;
        }
        if($request->file('logo')){
            if($id){//For update
                $Image_id = self::file($request->file('logo'),$id);
            }else{
                $Image_id = self::file($request->file('logo'));
            }
            $credentials['img_id'] = $Image_id;
        }
        return $credentials;
    }
    public static function file($file,$id = NULL)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/insurance/offer/';
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
            $Image->save();
        }
        $Image = Image::create(['name' => $fileName]);
        return $Image->id;
    }
}
