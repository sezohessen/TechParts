<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Exception;
class Seller extends Model
{
    const avatarBase     = '/img/avatar/';
    public const backgroundBase = '/img/background/';
    use HasFactory;
    protected $table    = 'sellers';
    protected $fillable=[
        'user_id',
        'bg',
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
            'desc'                     => 'nullable|min:10|max:255',
            'desc_ar'                  => 'required|min:10|max:255',
            'bg'                       => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'avatar'                   => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'governorate_id'           => 'required|integer|exists:governorates,id',
            'city_id'                  => 'required|integer|exists:cities,id',
            'lat'                      => 'required',
            'long'                     => 'required',
            'street'                   => 'required|min:3|max:100',
            'facebook'                 => 'nullable',
            'instagram'                => 'nullable',
            'file'                     => 'nullable|max:4096|mimes:doc,dot,docm,docx,dotx,pdf,xlxs,xls,xlsm,xlsb,xltx,txt,rar,zip',
            'specialty_id.*'           => 'required|exists:car_makers,id'
        ];
        return $rules;
    }
    public static function credentials($request,$seller)
    {
        $credentials = [
            'governorate_id'    => $request->governorate_id,
            'city_id'           => $request->city_id,
            'lat'               => $request->lat,
            'long'              => $request->long,
            'street'            => $request->street,
            'facebook'          => $request->facebook,
            'instagram'         => $request->instagram,
            'desc'              => $request->desc,
            'desc_ar'           => $request->desc_ar,
        ];
        // Store file
        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . rand(11111, 99999) . '.' . $extension;
            //Delete Old image
            $path = Storage::putFileAs(
                'files', $request->file, $fileName
            );
            if($file){
                try {
                    $file_old = $seller->file;
                    unlink(storage_path('app\files\\' . $file_old ));

                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            }
            $seller->file = $fileName;
        }
        // Store avatar
        if($request->file('avatar')){
            $Image_id = add_Image($request->file('avatar'),$seller->avatar,Seller::avatarBase);
            $seller->avatar = $Image_id;
        }
        // Store background
        if($request->file('bg')){
            $Image_id = add_Image($request->file('bg'),$seller->bg,Seller::backgroundBase);
            $seller->bg = $Image_id;
        }
        $seller->save();

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
    public function brands()
    {
        return $this->hasMany(BrandSeller::class);
    }
}
