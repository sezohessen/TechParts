<?php

namespace App\Models;

use Exception;
use App\Rules\periodValidate;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table    = 'cars';

    const TRANSIMSSION_AUTOMATIC  = 0;
    const TRANSIMSSION_MANUAL = 1;

    const PAYMENT_CASH  = 0;
    const PAYMENT_INSTALLMENT = 1;
    const PAYMENT_FINANCING = 2;


    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE  = 1;

    const IS_NEW  = 0;
    const IS_USED = 1;

    const FUEL_GAS  = 0;
    const FUEL_PETROL = 1;

    const SELLER_AGENCY=0;
    const SELLER_INDIVIDUAL=1;

    const NotAccidentBefore=0;
    const AccidentBefore=1;

    const NotAlert=0;
    const Alert=1;
    protected static $logAttributes = ['phone','Country_id', 'SellerType'];
    protected $fillable=[
        'price', 'price_after_discount','Description', 'Description_ar',
        'CarManufacture_id', 'status', 'kiloUsed','ServiceHistory' ,
        'lat','lng','phone','InstallmentAmount', 'InstallmentPeriod',
        'DepositPrice' ,'Country_id' ,'City_id' ,'Governorate_id' ,
        'CarModel_id' ,'CarMaker_id' ,'CarBody_id' ,'CarYear_id' ,
        'CarCapacity_id' ,'CarColor_id' ,'views' ,'AccidentBefore' ,
        'transmission' ,'payment', 'SellerType','isNew',"adsExpire",
        "promotedExpire","promotedStatus","user_id","whats","data","FuelType"
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "A car has been {$eventName}";
    }
    public static function PaymentType()
    {
        return [
            self::PAYMENT_CASH          => __('Cash'),
            self::PAYMENT_INSTALLMENT   => __('Installment'),
            self::PAYMENT_FINANCING     => __('Financing'),
        ];
    }
    public static function FuelType()
    {
        return [
            self::FUEL_GAS        => __('Gas'),
            self::FUEL_PETROL         => __('Petrol'),
        ];
    }
    public static function TransmissionType()
    {
        return [
            self::TRANSIMSSION_MANUAL        => __('Manual'),
            self::TRANSIMSSION_AUTOMATIC     => __('Automatic'),
        ];
    }
    public static function StatusType()
    {
        return [
            self::IS_NEW        => __('New'),
            self::IS_USED         => __('Used'),
        ];

    }
    public static function SellerType()
    {
        return [
            self::SELLER_AGENCY        => __('Agency'),
            self::SELLER_INDIVIDUAL    => __('Individual'),
        ];

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
            'payment'                     => 'required|integer',
            "FuelType"                    => 'required|integer',
            'phone'                       => 'required|string',
            'DepositPrice'                => 'required|integer',
            'InstallmentAmount'           => 'required|integer',
            'InstallmentPeriod'           => 'required|integer',
            'CarPhotos'                   => 'required|max:5',
            'CarPhotos.*'                 => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            "whats"                       => 'required|string',
            "price_after_discount"        =>'nullable|integer|between:0,100'
        ];
        if($id){
            $rules['CarPhotos'] = 'nullable';
            $rules['CarPhotos.*'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
    public static function credentials($request,$images_id = NULL)
    {
        $credentials = [
            'CarMaker_id'                 => $request->CarMaker_id,
            'CarModel_id'                 => $request->CarModel_id,
            'CarYear_id'                  => $request->CarYear_id,
            'CarManufacture_id'           => $request->CarManufacture_id,
            'CarCapacity_id'              => $request->CarCapacity_id,
            'price'                       => $request->price,
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
            'SellerType'                  => Auth()->user()->Agency ? Car::SELLER_AGENCY: Car::SELLER_INDIVIDUAL,
            'payment'                     => $request->payment,
            'phone'                       => $request->phone,
            'whats'                       => $request->whats,
            'DepositPrice'                => $request->DepositPrice,
            'InstallmentAmount'           => $request->InstallmentAmount,
            'InstallmentPeriod'           => $request->InstallmentPeriod,
            "FuelType"                    => $request->FuelType,
            'views'                       => 0,
            'status'                      => Car::STATUS_DISABLE,
            'user_id'                     => Auth()->user()->id
        ];
        if($photos=$request->file('CarPhotos')){
            if($images_id){
                foreach($photos as $key=>$photo){
                    $Images_id[] = self::file($photo);
                }
                foreach($images_id as $key=>$photo){
                    self::Updated_file($photo);
                }
            }else {
                foreach($photos as $photo){
                    $Images_id[] = self::file($photo);
                }
            }
            $credentials['CarPhotos'] = $Images_id;
        }
        if ($request->price_after_discount) {
            $credentials['price_after_discount']=$request->price_after_discount;
        }else {
            $credentials['price_after_discount']=0;
        }

        return $credentials;
    }
    public static function file($file,$id = NULL)
    {

        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/Cars/';
        $file->move($destinationPath, $fileName);
        $Image = Image::create(['name' => $fileName, 'base' => '/img/Cars/']);
        return $Image->id;
    }

    public static function Updated_file($file)
    {
        $destinationPath = public_path() . '/img/Cars/';
        $Image = Image::find($file->img_id);
        try {
            $file_old = $destinationPath.$Image->name;
            unlink($file_old);
        } catch (Exception $e) {

        }
        $Image->delete();
        return true;
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
        return $this->belongsTo(CarModel::class,"CarModel_id","id")->where('active','=', 1);
    }
    public function maker()
    {
        return $this->belongsTo(CarMaker::class,"CarMaker_id","id")->where('active','=', 1);
    }
    public function AuthFavCar()
    {
        return $this->belongsToMany(User::class, 'user_fav_cars', 'car_id','user_id');
    }
    public function AuthAlertCar()
    {
        return $this->belongsToMany(User::class, 'alerts', 'car_id','user_id')->withPivot('status');
    }

    public function OneAgency()
    {
        $agency=Agency::where('user_id',Auth()->id())->first();
        return $this->belongsToMany(Agency::class, 'agency_cars', 'car_id','agency_id')->where('agency_id',$agency->id);
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
            $Image->delete();
        }
        return true;
    }

    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function agencies()
    {
        return $this->belongsToMany(Agency::class, 'agency_cars', 'car_id','agency_id');
    }
    public function agencies_cars()
    {
    return $this->belongsToMany(Agency::class, 'agency_cars');
    }


}
