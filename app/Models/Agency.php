<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Agency extends Model
{
    use HasFactory;
    protected $table    = 'agencies';
    protected $fillable=[
        'name',
        'name_ar',
        'description',
        'description_ar',
        'show_in_home',
        'car_show_rooms',
        'center_type',
        'description_ar',
        'lat',
        'long',
        'car_status',
        'payment_method',
        'img_id',
        'country_id',
        'governorate_id',
        'city_id',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function governorate() {
        return $this->belongsTo(Governorate::class,'governorate_id','id');
    }
    public function city() {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function img(){
        return $this->belongsTo(Image::class,'img_id','id');
    }
    public static function rules($request,$id = NULL)
    {
        $rules = [
            'name'                  => 'required|string|max:255|min:3',
            'name_ar'               => 'required|string|max:255|min:3',
            'description'           => 'required|min:3|max:1000',
            'description_ar'        => 'required|min:3|max:1000',
            'center_type'           => 'required|integer',
            'car_status'            => 'required|integer',
            'payment_method'        => 'required|integer',
            'status'                => 'required|integer',
            'img_id'                => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'country_id'            => 'required',
            'governorate_id'        => 'required',
            'city_id'               => 'required',
            'lat'                   => 'nullable',
            'long'                  => 'nullable',
            'user_id'               => 'required',
            'facebook'              => 'nullable',
            'whatsapp'              => 'nullable',
            'instagram'             => 'nullable',
            'messenger'             => 'nullable',
        ];
        if($id == 'Agency'){//For update in Dashborad
            $rules['img_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }elseif($id){//For update in Insurance Dashboard
            $rules['img_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
            unset($rules['user_id']);
        }
        return $rules;
    }
    public static function credentials($request,$id = NULL,$img_id = NULL)
    {
        $credentials = [
            'name'              =>  $request->name,
            'name_ar'           =>  $request->name_ar,
            'description'       =>  $request->description,
            'description_ar'    =>  $request->description_ar,
            'center_type'       =>  $request->center_type,
            'car_status'        =>  $request->car_status,
            'payment_method'    =>  $request->payment_method,
            'status'            =>  $request->status,
            'country_id'        =>  $request->country_id,
            'governorate_id'    =>  $request->governorate_id,
            'city_id'           =>  $request->city_id,
            'lat'               =>  '12.222',//Will edit this after (Faker)
            'long'              =>  '12.222',
        ];

        if($id){//For updating
            $credentials['user_id'] = $id;
        }else{
            $credentials['user_id'] = $request->user_id;
        }
        /* $this->CreateOrIgnore($product,$request->discount,'discount'); */
        if($request->show_in_home!=NULL&&$request->show_in_home=='on'){
            $credentials['show_in_home'] = 1;
        }else{
            $credentials['show_in_home'] = 0;
        }
        if($request->car_show_rooms!=NULL&&$request->car_show_rooms=='on'){
            $credentials['car_show_rooms'] = 1;
        }else{
            $credentials['car_show_rooms'] = 0;
        }
        if($request->file('img_id')){
            if($id){
                $Image_id = self::file($request->file('img_id'),$img_id);
            }else{
                $Image_id = self::file($request->file('img_id'));
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
        $destinationPath = public_path() . '/img/agency/';
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
            return $Image->id;
        }else{
            $Image = Image::create(['name' => $fileName]);
            return $Image->id;
        }
    }
    public function CreateOrIgnore($table,$request,$name)
    {
        if(!is_null($request)){
            $table->$name = $request;
            $table->save();
        }
    }
}
