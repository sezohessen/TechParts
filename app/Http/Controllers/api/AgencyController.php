<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\AgencyCar;
use App\Models\AgencyCarMaker;
use App\Models\AgencyContact;
use App\Models\AgencyReview;
use App\Models\AskExpert;
use App\Models\CarMaker;
use App\Models\Image;
use Illuminate\Support\Facades\Response;
use App\Models\News;
use App\Models\UserFavAgency;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;
use App\Classes\Responseobject;

class AgencyController extends Controller
{
    use GeneralTrait;
    public function review(Request $request)
    {
        $this->lang($request);
        $data       = $request->all();

        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'rate'          => 'required|in:1,2,3,4,5',
            'price_type'    => 'required|in:1,2,3',
            'comment'       => 'required|min:3|max:1000',
            'center_id'     => 'required|integer',
            'token'         => 'required'
        ]);
        if (!$validator->fails()) {
            if(!auth()->user()){
                return $this->errorMessage(__('Login to see submit review'));
            }
            $agency     = Agency::find($request->center_id);
            if (!$agency) {
                return $this->errorMessage(__("No such Center id exist"));
            }
            $askExpert  = AgencyReview::create([
                'rate'          => $request->rate,
                'price'         => $request->price_type,
                'review'        => $request->comment,
                'agency_id'     => $request->center_id,
                'user_id'       => auth()->user()->id
            ]);
            return $this->returnSuccess(__("Your Review Has been created Successfully, Wait for Admin to Apply your review"));
        }else{
            return($this->ValidatorErrors($validator));
        }

    }
    public function agency(Request $request)
    {
        $this->lang($request);
        $validator  = $this->home($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Agency)
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No Agencies in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,$workType = false,$specializationList = false,$badgesList = false,$description = false,
                $paymentMethodList = false);
            }
            return $this->returnData("offersList",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function maintenance(Request $request)
    {
        $this->lang($request);
        $validator  = $this->home($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Maintenance)
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No maintenance centers in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,$workType = false,$specializationList = true,$badgesList = false,$description = false,
                $paymentMethodList = false);
            }
            return $this->returnData("centerList",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function spare(Request $request)
    {
        $this->lang($request);
        $validator  = $this->home($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Spare)
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No Spare parts centers in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,$workType = false,$specializationList = true,$badgesList = false,$description = false,
                $paymentMethodList = false);
            }
            return $this->returnData("centerList",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function detailsAgency(Request $request)
    {
        $this->lang($request);
        $validator = $this->Details($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id',$request->center_id)
            ->where('center_type',Agency::center_type_Agency)
            ->get();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,Agency::AgecnyType()[$agency->agency_type],$specializationList = false,$badgesList = true,$description = true,
                $paymentMethodList = true);
            }
            return $this->returnData("mCenter",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function detailsMaintenance(Request $request)
    {
        $this->lang($request);
        $validator = $this->Details($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id',$request->center_id)
            ->where('center_type',Agency::center_type_Maintenance)
            ->get();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,Agency::MaintenanceType()[$agency->maintenance_type],$specializationList = true,$badgesList = true,$description = true,
                $paymentMethodList = true);
            }
            return $this->returnData("mCenter",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function detailsSpare(Request $request)
    {
        $this->lang($request);
        $validator = $this->Details($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id',$request->center_id)
            ->where('center_type',Agency::center_type_Spare)
            ->get();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,Agency::types()[$agency->center_type],$specializationList = true,$badgesList = true,$description = true,
                $paymentMethodList = true);
            }
            return $this->returnData("mCenter",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function agencySearch(Request $request)
    {
        $this->lang($request);
        $validator = $this->Search($request);

        if (!$validator->fails()) {
            $carStatus      = $request->car_status ? Agency::UsedCar : Agency::NewCar;
            $name           = Session::get('app_locale')=='ar'? "name_ar" : "name";
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Agency)
            ->where('car_status',$carStatus)
            ->where($name,'like','%'.$request->word.'%')
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No centers found"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,$workType = false,$specializationList = false,$badgesList = false,$description = false,
                $paymentMethodList = false,$centerType = false);
            }
            return $this->returnData("centerList",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function maintenanceSearch(Request $request)
    {
        $this->lang($request);
        $validator = $this->Search($request);

        if (!$validator->fails()) {
            $carStatus      = $request->car_status ? Agency::UsedCar : Agency::NewCar;
            $name           = Session::get('app_locale')=='ar'? "name_ar" : "name";
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Maintenance)
            ->where('car_status',$carStatus)
            ->where($name,'like','%'.$request->word.'%')
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No centers found"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,$workType = false,$specializationList = true,$badgesList = false,$description = false,
                $paymentMethodList = false);
            }
            return $this->returnData("centerList",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));

        }
    }
    public function spareSearch(Request $request)
    {
        $this->lang($request);
        $validator = $this->Search($request);

        if (!$validator->fails()) {
            $carStatus      = $request->car_status ? Agency::UsedCar : Agency::NewCar;
            $name           = Session::get('app_locale')=='ar'? "name_ar" : "name";
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Spare)
            ->where('car_status',$carStatus)
            ->where($name,'like','%'.$request->word.'%')
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No centers found"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency,$workType = false,$specializationList = true,$badgesList = false,$paymentMethodList = false,$centerType = false);
            }
            return $this->returnData("centerList",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));

        }
    }
    public function agencyFav(Request $request)
    {
        $this->lang($request);
        $validator = $this->Favorite($request,'agency');

        if (!$validator->fails()) {
            if(!auth()->user()){
                return $this->errorMessage(__('Login to see your favorite'));
            }

            if(!auth()->user()->agencyFav->count()){
                return $this->returnSuccess(__("No centers found"));
            }
            $agencyList = auth()->user()->agencyFav;
            foreach ($agencyList as $agency) {

                $agencies[]     = $this->AgencyData($agency,$workType = false,$specializationList = false,$badgesList = false,$description = false,
                $paymentMethodList = false,$centerType = false,$mContact = false,$mLocation = false,$carMakerList = false);
            }
            return $this->returnData("agencyList",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function centerFav(Request $request)
    {
        $this->lang($request);
        $validator = $this->Favorite($request,'center');

        if (!$validator->fails()) {
            if(!auth()->user()){
                return $this->errorMessage(__('Login to see your favorite'));
            }

            if(!auth()->user()->MaintenanceFav->count()){
                return $this->returnSuccess(__("No centers found"));
            }
            $agencyList = auth()->user()->agencyFav;
            foreach ($agencyList as $agency) {

                $agencies[]     = $this->AgencyData($agency,$workType = false,$specializationList = false,$badgesList = false,$description = false,
                $paymentMethodList = false,$centerType = false,$mContact = false,$mLocation = false,$carMakerList = false);
            }
            return $this->returnData("maintenanceList",$agencies,"Successfully");
        }else{
            return($this->ValidatorErrors($validator));
        }
    }
    public function Contact($agency)
    {
        // mContact Row
        $mContact = [
            "face"          => null,
            "instagram"     => null,
            "messenger"     => null,
            "phone"         => null,
            "whats"         => null,
        ];

        if ($agency->AgencyContact ) {
            $mContact = [
                "face"          => $agency->AgencyContact->facebook,
                "instagram"     => $agency->AgencyContact->instagram,
                "messenger"     => $agency->AgencyContact->messenger,
                "phone"         => $agency->user->phone,//May be i will edit this
                "whats"         => $agency->AgencyContact->whatsapp,
            ];
        }
        return $mContact;
    }
    public function PriceRange($agency)
    {
         // Price Row
         $agencyCars     = AgencyCar::where('agency_id',$agency->id)->get();

         $Max = 0;
         $Min = 100000000;
         foreach ($agencyCars as $agencyCar) {
             $price = $agencyCar->car->price;
             if($price>$Max){
                 $Max = $price;
             }
             if($price<$Min){
                 $Min = $price;
             }
         }
         if(!$agencyCars->count()){
             $Max = 0;
             $Min = 0;
        }
        return array($Max,$Min);
    }
    public function Location($agency)
    {
        // mLocation Row
        $mLocation = [
            "city_name"         => Session::get('app_locale')=='ar'? $agency->city->title_ar : $agency->city->title ,
            "government_name"   => Session::get('app_locale')=='ar'? $agency->governorate->title_ar : $agency->governorate->title,
            "latitude"          => $agency->lat,
            "longitude"         => $agency->long,
        ];

        return $mLocation;
    }
    public function carMakerList($agency)
    {
        // Car Maker Row
        $carMakerList       = [];
        if($agency->carMakers){
            foreach ($agency->carMakers as $CarMaker) {
                $logo           = @$CarMaker->logo->name;
                $carMakerList[] = $logo;
            }
        }
        return $carMakerList;
    }
    public function isFav($agency)
    {
        // Favorite Row
        $isFavorite = false;
        if(auth()->user()){
            $fav    = UserFavAgency::where('agency_id',$agency->id)
            ->where('user_id',auth()->user()->id)
            ->first();
            if($fav->count()){
                $isFavorite = true;
            }
        }
        return $isFavorite;
    }
    public function rate($agency)
    {
        // Rate Row
        $rate   = AgencyReview::where('agency_id',$agency->id)
        ->selectRaw('SUM(rate)/COUNT(user_id) AS avg_rating')
        ->first()
        ->avg_rating;
        return $rate;
    }
    public function specializationList($agency)
    {
        // specializationList
        $specializationList = [];
        if($agency->agency_specialties){
            foreach ($agency->agency_specialties as $list) {
                $specializationList[]   = Session::get('app_locale')=='ar'? $list->name_ar : $list->name;
            }
        }
        return $specializationList;
    }
    public function lang($request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
    }
    public function ValidatorErrors($validator)
    {
        $response           = new Responseobject();       # $response->status   = $response::status_failed;
        $response->code     = $response::code_failed;
        foreach ($validator->errors()->getMessages() as $item) {
            array_push($response->messages, $item);
        }
        return Response::json(
            $response
        );
    }
    public function AgencyData($agency,$workType = 1
    ,$specializationList = 1,$badgesList = 1,$description = 1,$paymentMethodList = 1,$centerType = 1
    ,$mContact = 1,$mLocation = 1,$carMakerList = 1)//Power Full Function :P
    {
        list($Max,$Min)             = $this->PriceRange($agency);
        $agencies = [
            "centerType"            => Agency::types()[$agency->center_type],
            "id"                    => $agency->id,
            "logo"                  => $agency->img->name,
            "title"                 => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
            "description"           => Session::get('app_locale')=='ar'? $agency->description_ar : $agency->description,
            "isAuthorised"          => $agency->is_authorised ? true : false,
            "priceRangeMax"         => $Max,
            "priceRangeMin"         => $Min,
            "rate"                  => $this->rate($agency),
            "isFavorite"            => $this->isFav($agency),
            "mContact"              => $this->Contact($agency),
            "mLocation"             => $this->Location($agency),
            "carMakerList"          => $this->carMakerList($agency),
            "specializationList"    => $this->specializationList($agency),
            "paymentMethodList"     => Agency::payment()[$agency->payment_method],
            "workType"              => $workType,
            "badgesList"            => Agency::status()[$agency->status],
        ];
        if(!$specializationList)unset($agencies["specializationList"]);
        if(!$workType)unset($agencies["workType"]);
        if(!$badgesList)unset($agencies["badgesList"]);
        if(!$specializationList)unset($agencies["specializationList"]);
        if(!$description)unset($agencies["description"]);
        if(!$paymentMethodList)unset($agencies["paymentMethodList"]);
        if(!$centerType)unset($agencies["centerType"]);
        if(!$mContact)unset($agencies["mContact"]);
        if(!$mLocation)unset($agencies["mLocation"]);
        if(!$carMakerList)unset($agencies["carMakerList"]);
        return $agencies;
    }
    public function Search($request)
    {
        $data       = $request->all();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer',//Will be updated
            'token'             => 'nullable',
            'car_status'        => 'required|in:0,1|integer',
            'word'              => 'required|regex:/^[a-z0-9\s]+$/i'
        ]);
        return $validator;
    }
    public function Details($request)
    {
        $data       = $request->all();

        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'center_id'         => 'required|integer',
            'token'             => 'nullable',
        ]);
        return $validator;
    }
    public function home($request)
    {
        $data       = $request->all();

        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer',
            'token'             => 'nullable',
        ]);
        return $validator;
    }
    public function Favorite($request,$type)
    {
        $data       = $request->all();

        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'token'             => 'required',
            'favorite_type'     => 'required|in:'.$type
        ]);
        return $validator;
    }
}
