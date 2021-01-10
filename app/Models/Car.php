<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table    = 'cars';

    const TRANSIMSSION_MANUAL  = 0;
    const TRANSIMSSION_AUTOMATIC = 1;

    const PAYMENT_CASH  = 0;
    const PAYMENT_INSTALLMENT = 1;
    const PAYMENT_FINANCING = 3;

    const STATUS_NEW  = 0;
    const STATUS_USED = 1;

    const SELLER_AGENCY=0;
    const SELLER_DISTRIBUTOR=1;
    const SELLER_INDIVIDUAL=2;


    protected $fillable=[
        'price',
        'price_after_discount',
        'Description',
        'Description_ar',
        'CarManufacture_id',
        'status',
        'kiloUsed',
        'ServiceHistory' ,
        'lat',
        'lng',
        'phone',
        'InstallmentMonth',
        'InstallmentPrice',
        'DepositPrice' ,
        'Country_id' ,
        'City_id' ,
        'Governorate_id' ,
        'CarModel_id' ,
        'CarMaker_id' ,
        'CarBody_id' ,
        'CarYear_id' ,
        'CarCapacity_id' ,
        'CarColor_id' ,
        'views' ,
        'AccidentBefore' ,
        'transmission' ,
        'payment',
        'SellerType',

    ];
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
            $Image->save();
            return $Image->id;
        }else{
            $Image = Image::create(['name' => $fileName]);
            return $Image->id;
        }
    }
}
