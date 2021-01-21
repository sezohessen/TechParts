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
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'rate'          => 'required|in:1,2,3,4,5',
            'price_type'    => 'required|in:1,2,3',
            'comment'       => 'required|min:3|max:1000',
            'center_id'     => 'required|integer',
            'token'         => 'nullable'
        ]);
        if (!$validator->fails()) {
            $agency     = Agency::find($request->center_id);
            if (!$agency) {
                return $this->errorMessage(__("No such Center id exist"));
            }
            $askExpert  = AgencyReview::create([
                'rate'          => $request->rate,
                'price'         => $request->price_type,
                'review'        => $request->comment,
                'agency_id'     => $request->center_id,
            ]);
            if ($request->token) {
                $askExpert->user_id = auth()->user();
                $askExpert->save();
            }
            return $this->returnSuccess(__("Your Review Has been created Successfully, Wait for Admin to Apply your review"));
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }

    }
    public function agency(Request $request)
    {
        $this->lang($request);
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer',//Will be updated
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Agency)
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No Agencies in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                list($Max,$Min) = $this->PriceRange($agency);

                $agencies[] = [
                    "centerType"    => Agency::types()[$agency->center_type],
                    "id"            => $agency->id,
                    "logo"          => $agency->img->name,
                    "title"         => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                    "isAuthorised"  => $agency->is_authorised ? true : false,
                    "rate"          => $this->rate($agency),
                    "priceRangeMax" => $Max,
                    "priceRangeMin" => $Min,
                    "isFavorite"    => $this->isFav($agency),
                    "mContact"      => $this->Contact($agency),
                    "mLocation"     => $this->Location($agency),
                    "carMakerList"  => $this->carMakerList($agency)
                ];
            }
            return $this->returnData("offersList",$agencies,"Successfully");
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function maintenance(Request $request)
    {
        $this->lang($request);
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer',
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Maintenance)
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No maintenance centers in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                list($Max,$Min) = $this->PriceRange($agency);

                $agencies[] = [
                    "centerType"            => Agency::types()[$agency->center_type],
                    "id"                    => $agency->id,
                    "logo"                  => $agency->img->name,
                    "title"                 => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                    "isAuthorised"          => $agency->is_authorised ? true : false,
                    "rate"                  => $this->rate($agency),
                    "priceRangeMax"         => $Max,
                    "priceRangeMin"         => $Min,
                    "isFavorite"            => $this->isFav($agency),
                    "mContact"              => $this->Contact($agency),
                    "mLocation"             => $this->Location($agency),
                    "carMakerList"          => $this->carMakerList($agency),
                    "specializationList"    => $this->specializationList($agency)
                ];
            }
            return $this->returnData("centerList",$agencies,"Successfully");
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function spare(Request $request)
    {
        $this->lang($request);
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer',
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',Agency::center_type_Spare)
            ->paginate();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No Spare parts centers in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                list($Max,$Min) = $this->PriceRange($agency);

                $agencies[] = [
                    "centerType"            => Agency::types()[$agency->center_type],
                    "id"                    => $agency->id,
                    "logo"                  => $agency->img->name,
                    "title"                 => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                    "isAuthorised"          => $agency->is_authorised ? true : false,
                    "rate"                  => $this->rate($agency),
                    "priceRangeMax"         => $Max,
                    "priceRangeMin"         => $Min,
                    "isFavorite"            => $this->isFav($agency),
                    "mContact"              => $this->Contact($agency),
                    "mLocation"             => $this->Location($agency),
                    "carMakerList"          => $this->carMakerList($agency),
                    "specializationList"    => $this->specializationList($agency)
                ];
            }
            return $this->returnData("centerList",$agencies,"Successfully");
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function detailsAgency(Request $request)
    {
        $this->lang($request);
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'center_id'         => 'required|integer',
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id',$request->center_id)
            ->where('center_type',Agency::center_type_Agency)
            ->get();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                list($Max,$Min) = $this->PriceRange($agency);

                $agencies[] = [
                    "centerType"        => Agency::types()[$agency->center_type],
                    "paymentMethodList" => Agency::payment()[$agency->payment_method],
                    "workType"          => Agency::AgecnyType()[$agency->agency_type],
                    "badgesList"        => Agency::status()[$agency->status],
                    "id"                => $agency->id,
                    "logo"              => $agency->img->name,
                    "description"       => Session::get('app_locale')=='ar'? $agency->description_ar : $agency->description,
                    "title"             => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                    "isAuthorised"      => $agency->is_authorised ? true : false,
                    "rate"              => $this->rate($agency),
                    "priceRangeMax"     => $Max,
                    "priceRangeMin"     => $Min,
                    "isFavorite"        => $this->isFav($agency),
                    "mContact"          => $this->Contact($agency),
                    "mLocation"         => $this->Location($agency),
                    "carMakerList"      => $this->carMakerList($agency)
                ];
            }
            return $this->returnData("mCenter",$agencies,"Successfully");
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function detailsMaintenance(Request $request)
    {
        $this->lang($request);
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'center_id'         => 'required|integer',
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id',$request->center_id)
            ->where('center_type',Agency::center_type_Maintenance)
            ->get();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                list($Max,$Min) = $this->PriceRange($agency);
                $agencies[] = [
                    "centerType"        => Agency::types()[$agency->center_type],
                    "paymentMethodList" => Agency::payment()[$agency->payment_method],
                    "workType"          => Agency::MaintenanceType()[$agency->maintenance_type],
                    "badgesList"        => Agency::status()[$agency->status],
                    "id"                => $agency->id,
                    "logo"              => $agency->img->name,
                    "description"       => Session::get('app_locale')=='ar'? $agency->description_ar : $agency->description,
                    "title"             => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                    "isAuthorised"      => $agency->is_authorised ? true : false,
                    "rate"              => $this->rate($agency),
                    "priceRangeMax"     => $Max,
                    "priceRangeMin"     => $Min,
                    "isFavorite"        => $this->isFav($agency),
                    "mContact"          => $this->Contact($agency),
                    "mLocation"         => $this->Location($agency),
                    "carMakerList"      => $this->carMakerList($agency),
                    "specializationList"=> $this->specializationList($agency)
                ];
            }
            return $this->returnData("mCenter",$agencies,"Successfully");
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function detailsSpare(Request $request)
    {
        $this->lang($request);
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'center_id'         => 'required|integer',
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id',$request->center_id)
            ->where('center_type',Agency::center_type_Spare)
            ->get();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                list($Max,$Min) = $this->PriceRange($agency);

                $agencies[] = [
                    "centerType"        => Agency::types()[$agency->center_type],
                    "paymentMethodList" => Agency::payment()[$agency->payment_method],
                    "workType"          => Agency::types()[$agency->center_type],
                    "badgesList"        => Agency::status()[$agency->status],
                    "id"                => $agency->id,
                    "logo"              => $agency->img->name,
                    "description"       => Session::get('app_locale')=='ar'? $agency->description_ar : $agency->description,
                    "title"             => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                    "isAuthorised"      => $agency->is_authorised ? true : false,
                    "rate"              => $this->rate($agency),
                    "priceRangeMax"     => $Max,
                    "priceRangeMin"     => $Min,
                    "isFavorite"        => $this->isFav($agency),
                    "mContact"          => $this->Contact($agency),
                    "mLocation"         => $this->Location($agency),
                    "carMakerList"      => $this->carMakerList($agency),
                    "specializationList"=> $this->specializationList($agency)
                ];
            }
            return $this->returnData("mCenter",$agencies,"Successfully");
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function agencySearch(Request $request)
    {
        $this->lang($request);
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer',//Will be updated
            'token'             => 'nullable',
            'car_status'        => 'required|in:0,1|integer',
            'word'              => 'required|regex:/^[a-z0-9\s]+$/i'
        ]);

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
                list($Max,$Min) = $this->PriceRange($agency);

                $agencies[] = [
                    "centerType"    => Agency::types()[$agency->center_type],
                    "id"            => $agency->id,
                    "logo"          => $agency->img->name,
                    "title"         => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                    "isAuthorised"  => $agency->is_authorised ? true : false,
                    "rate"          => $this->rate($agency),
                    "priceRangeMax" => $Max,
                    "priceRangeMin" => $Min,
                    "isFavorite"    => $this->isFav($agency),
                    "mContact"      => $this->Contact($agency),
                    "mLocation"     => $this->Location($agency),
                    "carMakerList"  => $this->carMakerList($agency)
                ];
            }
            return $this->returnData("centerList",$agencies,"Successfully");
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
    public function maintenanceSearch(Request $request)
    {
        dd(1);
    }
    public function spareSearch(Request $request)
    {
        dd(1);
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
}
