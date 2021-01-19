<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table    = 'cars';

    const TRANSIMSSION_MANUAL  = 0;
    const TRANSIMSSION_AUTOMATIC = 1;

    const PAYMENT_CASH  = 0;
    const PAYMENT_INSTALLMENT = 1;
    const PAYMENT_FINANCING = 3;

    const STATUS_ACTIVE  = 0;
    const STATUS_DISABLE = 1;

    const IS_NEW  = 0;
    const IS_USED = 1;

    const SELLER_AGENCY=0;
    const SELLER_DISTRIBUTOR=1;
    const SELLER_INDIVIDUAL=2;

    protected static $logAttributes = ['phone','Country_id', 'SellerType'];
    protected $fillable=[
        'price', 'price_after_discount','Description', 'Description_ar',
        'CarManufacture_id', 'status', 'kiloUsed','ServiceHistory' ,
        'lat','lng','phone','InstallmentMonth', 'InstallmentPrice',
        'DepositPrice' ,'Country_id' ,'City_id' ,'Governorate_id' ,
        'CarModel_id' ,'CarMaker_id' ,'CarBody_id' ,'CarYear_id' ,
        'CarCapacity_id' ,'CarColor_id' ,'views' ,'AccidentBefore' ,
        'transmission' ,'payment', 'SellerType','isNew'
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "A car has been {$eventName}";
    }

    public static function rules($request,$id = NULL)
    {
        $rules = [
            'CarMaker_id'                 => 'required|integer',
            'CarModel_id'                 => 'required|integer',
            'CarYear_id'                  => 'required|integer',
            'CarManufacture_id'           => 'required|integer',
            'CarCapacity_id'              => 'required|integer',
            'price'                       => 'required|integer',
            'price_after_discount'        => 'required|integer|between:1,100',
            'AccidentBefore'              => 'required|integer',
            'kiloUsed'                    => 'required|integer',
            'CarBody_id'                  => 'required|integer',
            'CarColor_id'                 => 'required|integer',
            'badge_id'                    => 'required|array|min:1',
            'feature_id'                  => 'required|array|min:1',
            'Description'                 => 'required|string|min:3|max:1000',
            'Description_ar'              => 'required|string|min:3|max:1000',
            'Country_id'                  => 'required|integer',
            'Governorate_id'              => 'required|integer',
            'City_id'                     => 'required|integer',
            'lat'                         => 'required|numeric',
            'lng'                         => 'required|numeric',
            'ServiceHistory'              => 'required|string|min:3|max:1000',
            'transmission'                => 'required|integer',
            'isNew'                       => 'required|integer',
            'SellerType'                  => 'required|integer',
            'payment'                     => 'required|integer',
            'phone'                       => 'required|numeric',
            'DepositPrice'                => 'required|integer',
            'InstallmentPrice'            => 'required|integer',
            'InstallmentMonth'            => 'required|integer|between:1,12',
            'CarPhotos'                   => 'required|max:5',
            'CarPhotos.*'                 => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ];
        if($id){
            $rules['CarPhotos'] = 'nullable';
            $rules['CarPhotos.*'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
    public static function credentials($request,$img_id = NULL)
    {
        $credentials = [

            'CarMaker_id'                 => $request->CarMaker_id,
            'CarModel_id'                 => $request->CarModel_id,
            'CarYear_id'                  => $request->CarYear_id,
            'CarManufacture_id'           => $request->CarManufacture_id,
            'CarCapacity_id'              => $request->CarCapacity_id,
            'price'                       => $request->price,
            'price_after_discount'        => $request->price_after_discount,
            'AccidentBefore'              => $request->AccidentBefore,
            'kiloUsed'                    => $request->kiloUsed,
            'CarBody_id'                  => $request->CarBody_id,
            'CarColor_id'                 => $request->CarColor_id,
            'Description'                 => $request->Description,
            'Description_ar'              => $request->Description_ar,
            'Country_id'                  => $request->Country_id,
            'Governorate_id'              => $request->Governorate_id,
            'City_id'                     => $request->City_id,
            'lat'                         => $request->lat,
            'lng'                         => $request->lng,
            'ServiceHistory'              => $request->ServiceHistory,
            'transmission'                => $request->transmission,
            'isNew'                       => $request->isNew,
            'SellerType'                  => $request->SellerType,
            'payment'                     => $request->payment,
            'phone'                       => $request->phone,
            'DepositPrice'                => $request->DepositPrice,
            'InstallmentPrice'            => $request->InstallmentPrice,
            'InstallmentMonth'            => $request->InstallmentMonth,
            'views'                       => 0,
            'status'                      => Car::STATUS_ACTIVE
        ];
        if($photos=$request->file('CarPhotos')){
            if($img_id){
                foreach($photos as $photo){
                    $Image_id[] = self::file($photo,$img_id);
                }
            }else {
                foreach($photos as $photo){
                    $Image_id[] = self::file($photo);
                }
            }
            $credentials['CarPhotos'] = $Image_id;
        }
        return $credentials;
    }
    public static function file($file,$id = NULL)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/Cars/';
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
    public function maker()
    {
        return $this->belongsTo(CarMaker::class,"CarMaker_id","id")->where('active','=', 1);
    }
    public function make()
    {
        return $this->belongsTo(CarMaker::class,"CarMaker_id","id");
    }

    public function year()
    {
        return $this->belongsTo(CarYear::class,"CarYear_id","id");
    }
    public function color()
    {
        return $this->belongsTo(CarColor::class,"CarColor_id","id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class,"Country_id","id");
    }

    public function city()
    {
        return $this->belongsTo(City::class,"City_id","id");
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class,"Governorate_id","id");
    }

    public function badges()
    {
        return $this->hasMany(car_badge::class,"car_id","id");
    }
    public function features()
    {
        return $this->hasMany(car_feature::class,"car_id","id");
    }
    public function images()
    {
        return $this->hasMany(car_img::class,"car_id","id");
    }
    public function manufacture()
    {
        return $this->belongsTo(CarManufacture::class,"CarManufacture_id","id");
    }
    public function body()
    {
        return $this->belongsTo(CarBody::class,"CarBody_id","id");
    }
    public function model()
    {
        return $this->belongsTo(CarMaker::class,"CarMaker_id","id")->where('active','=', 1);
    }


    public static function unlink_img($images)
    {
        $destinationPath = public_path() . '/img/Cars/';
        foreach($images as $key=>$image){
            $Image = Image::find($image->img_id);
            //Delete Old image
            try {
                $file_old = $destinationPath.$Image->name;
                unlink($file_old);
            } catch (Exception $e) {}
        }
        return true;
    }


}
