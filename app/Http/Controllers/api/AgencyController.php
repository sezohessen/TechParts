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
class Responseobject
{
    const status_ok = "OK";
    const status_failed = "FAILED";
    const code_ok = 200;
    const code_failed = 400;
    const code_unauthorized = 403;
    const code_not_found = 404;
    const code_error = 500;
    public $status;
    public $code;
    public $messages = array();
}
class AgencyController extends Controller
{
    use GeneralTrait;
    public function review(Request $request)
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
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'rate'          => 'in:1,2,3,4,5',
            'price_type'    => 'in:1,2,3',
            'comment'       => 'required|min:3|max:1000',
            'center_id'     => 'required|integer',
            'token'         => 'nullable'
        ]);
        if (!$validator->fails()) {
            $agency     = Agency::find($request->center_id);
            if(!$agency){
                return $this->errorMessage(__("No such Center id exist"));
            }
            $askExpert  = AgencyReview::create([
                'rate'          => $request->rate,
                'price'         => $request->price_type,
                'review'        => $request->comment,
                'agency_id'     => $request->center_id,
            ]);
            if($request->token){
                $askExpert->user_id = auth()->user();
                $askExpert->save();
            }
            return $this->returnSuccess(__("Your Review Have been created Successfully, Wait for Admin to Apply your review"));
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
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer',//Will be updated
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id',$request->interest_country)
            ->where('center_type',0)
            ->get();
            if(!$agencyList->count()){
                return $this->returnSuccess(__("No Agencies in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                list($Max,$Min) = $this->PriceRange($agency);

                $agencies[] = [
                    "centerType"    => __("Agency"),
                    "id"            => $agency->id,
                    "logo"          => $agency->img->name,
                    "title"         => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                    "isAuthorised"  => $agency->is_authorised,
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

    }
    public function spare(Request $request)
    {
        dd(2);
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
}
