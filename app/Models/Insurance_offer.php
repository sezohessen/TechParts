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
    public static function rules($request)
    {
        $rules = [
            'title'              => 'required|string|max:255',
            'title_ar'           => 'required|string|max:255',
            'logo'              => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'insurance_id'      => 'required',
            'description'       => 'required|min:3|max:1000',
            'description_ar'    => 'required|min:3|max:1000',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'title'           =>  $request->title,
            'title_ar'        =>  $request->title_ar,
            'insurance_id'    =>  $request->insurance_id,
            'description'     =>  $request->description,
            'description_ar'  =>  $request->description_ar,
        ];
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
        $destinationPath = public_path() . '/img/insurance/offer/';
        $file->move($destinationPath, $fileName);
        $Image = Image::create(['name' => $fileName]);
        return $Image->id;
    }
}
