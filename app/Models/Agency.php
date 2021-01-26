<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Agency extends Model
{
    //Center type
    const center_type_Agency        = 0;
    const center_type_Maintenance   = 1;
    const center_type_Spare         = 2;
    // Payment Methods
    const Cash          = 0;
    const Installment   = 1;
    const Financial     = 2;
    //badgesList
    const Status_Normal     = 0;
    const Status_Premium    = 1;
    const Status_Trusted    = 2;
    // Car status
    const NewCar     = 0;
    const UsedCar    = 1;
    // Work Type
    const UnSelected            = 0;

    const Ag_Agency             = 1;
    const Ag_Distributor        = 2;
    const Ag_Individual         = 3;

    const Main_Service_center   = 1;
    const Main_Workshop         = 2;

    const Spare             = 0;

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
        'user_id',
        'agency_type',
        'maintenance_type',
        'is_authorised',
        'active'
    ];
    /* Agency::types()[$agency->type] */
    public static function types()
    {
        return [
            self::center_type_Agency        => __('Agency'),
            self::center_type_Maintenance   => __('Maintenance'),
            self::center_type_Spare         => __('Spare'),
        ];
    }
    public static function payment()
    {
        return [
            self::Cash          => __('Cash'),
            self::Installment   => __('Installment'),
            self::Financial     => __('Financial'),
        ];
    }
    public static function status()
    {
        return [
            self::Status_Normal     => __('Normal'),
            self::Status_Premium    => __('Premium'),
            self::Status_Trusted    => __('Trusted'),
        ];
    }
    public static function MaintenanceType()
    {
        return [
            self::UnSelected            => __('Un selected work type'),
            self::Main_Service_center   => __('Service center'),
            self::Main_Workshop         => __('Workshop'),
        ];
    }
    public static function AgecnyType()
    {
        return [
            self::UnSelected        => __('Un selected work type'),
            self::Ag_Agency         => __('Agency'),
            self::Ag_Distributor    => __('Distributor'),
        ];
    }
    public static function StyleAgecnyType()
    {
        return [
            [
                self::UnSelected        => "<span class='label label-danger label-inline mr-2'
                style='padding: 30px;
                width: 128px;'>".__('Un selected work type')."</span>",
                self::Ag_Agency         => "<span class='label label-warning label-inline mr-2'
                style='padding: 30px;
                width: 128px;'>".__('Agency')."</span>",
                self::Ag_Distributor    =>"<span class='label label-success label-inline mr-2'
                style='padding: 30px;
                width: 128px;'>".__('Distributor')."</span>",
                self::Ag_Individual    =>"<span class='label label-dark label-inline mr-2'
                style='padding: 30px;
                width: 128px;'>".__('Individual')."</span>",

            ],
            [
                self::UnSelected        => "<span class='label label-info label-inline mr-2'
                style='padding: 30px;
                width: 128px;'>".__('Un selected work type')."</span>",
                self::Main_Service_center         => "<span class='label label-dark label-inline mr-2'
                style='padding: 30px;
                width: 128px;'>".__('Service center')."</span>",
                self::Main_Workshop    =>"<span class='label label-primary label-inline mr-2'
                style='padding: 30px;
                width: 128px;'>".__('Workshop')."</span>"
            ],
            [
                self::Spare =>"<span class='label label-secondary label-inline mr-2'
                style='padding: 30px;
                width: 128px;'>".__('Spare')."</span>",
            ]

        ];
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function governorate() {
        return $this->belongsTo(Governorate::class,'governorate_id','id');
    }
    public function city() {
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function AgencyContact()
    {
        return $this->belongsTo(AgencyContact::class, 'id', 'agent_id');
    }
    public function img(){
        return $this->belongsTo(Image::class,'img_id','id');
    }
    public function carMakers()
    {
        return $this->belongsToMany(CarMaker::class, 'agency_car_makers', 'agency_id','CarMaker_id')->where('active', '=', 1);
    }
    public function Car()/* CarModel_id */
    {
        return $this->belongsToMany(Car::class, 'agency_cars', 'agency_id','car_id');
    }
    public function agency_specialties()
    {
        return $this->belongsToMany(Specialties::class, 'agency_specialties', 'agency_id','specialty_id');
    }

    public static function rules($request,$id = NULL)
    {
        $rules = [
            'name'                  => 'required|string|max:255|min:3',
            'name_ar'               => 'required|string|max:255|min:3',
            'description'           => 'required|min:3|max:1000',
            'description_ar'        => 'required|min:3|max:1000',
            'center_type'           => 'required|integer',
            "maintenance_type"      => "required_if:center_type,==,1",
            "agency_type"           => "required_if:center_type,==,0",
            'specialty_id'          => "required_if:center_type,==,1|array",
            'specialty_id.*'        => "required_if:center_type,==,1|distinct",
            'specialty_id_spare'    => "required_if:center_type,==,2|array",
            'specialty_id_spare.*'  => "required_if:center_type,==,2|distinct",
            'car_status'            => 'required|integer',
            'payment_method'        => 'required|integer',
            'status'                => 'required|integer',
            'img_id'                => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'country_id'            => 'required',
            'governorate_id'        => 'required',
            'city_id'               => 'required',
            'lat'                   => 'required',
            'long'                  => 'required',
            'user_id'               => 'required',
            'active'                => 'nullable'
        ];
        if($id == 'Agency'){//For update in Dashborad
            $rules['img_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }elseif($id == 'AgencyDash'){//For Create in Agency Dashboard
            unset($rules['status']);
            unset($rules['user_id']);
        }elseif($id){//For Update in Agency Dashboard
            $rules['img_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
            unset($rules['status']);
            unset($rules['user_id']);
        }
        return $rules;
    }
    public static function credentials($request,$id = NULL,$img_id = NULL,$specialCase = 1)
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
            'lat'               =>  $request->lat,
            'long'              =>  $request->long,
            'active'            =>  1
        ];
        if ($request->center_type==0) {
            $credentials['agency_type']         = $request->agency_type;
            $credentials['maintenance_type']    = 0;//Need it in Update
        }elseif($request->center_type==1) {
            $credentials['maintenance_type']    = $request->maintenance_type;
            $credentials['agency_type']         = 0;//Need it in Update
        }else{
            $credentials['maintenance_type']    = 0;//Need it in Update
            $credentials['agency_type']         = 0;//Need it in Update
        }
        if($id){//For updating
            $credentials['user_id'] = $id;
        }else{
            $credentials['user_id'] = $request->user_id;
        }
        if(!$specialCase&&$img_id){
            unset($credentials['status']);
        }
        if($request->show_in_home!=NULL&&$request->show_in_home=='on'&&$specialCase){//Check Box
            $credentials['show_in_home'] = 1;
        }else{
            $credentials['show_in_home'] = 0;
        }
        if($request->car_show_rooms!=NULL&&$request->car_show_rooms=='on'&&$specialCase){//Check Box
            $credentials['car_show_rooms'] = 1;
        }else{
            $credentials['car_show_rooms'] = 0;
        }
        if($request->is_authorised!=NULL&&$request->is_authorised=='on'&&$specialCase){//Check Box
            $credentials['is_authorised'] = 1;
        }else{
            $credentials['is_authorised'] = 0;
        }
        if($request->file('img_id')){//Creating and Updating Image
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
    public function reviews()
    {
        return $this->hasMany(AgencyReview::class, 'agency_id', 'id');
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
            $Image = Image::create(['name' => $fileName,'base'=>"/img/agency/"]);
            return $Image->id;
        }
    }
}
