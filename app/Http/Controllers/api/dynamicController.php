<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\api;
use App\Models\Car;
use App\Models\Faq;
use App\Models\City;
use App\Models\Agency;
use App\Models\Country;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use App\Models\Governorate;
use App\Models\AgencyReview;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Classes\Responseobject;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarYearResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\CarMakerCollection;
use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarCapacityResource;
use App\Models\CarYear;
use Illuminate\Support\Facades\Validator as Validator;

class dynamicController extends Controller
{
    use GeneralTrait;
    public function Validator($request,$rules,$niceNames=[])
    {
        $this->lang($request);
        return Validator::make($request->all(),$rules,[],$niceNames);
    }
    public function failed($validator)
    {
        $response   = new Responseobject();
        $response->status = $response::status_failed;
        $response->code = $response::code_failed;
        foreach ($validator->errors()->getMessages() as $item) {
            array_push($response->msg, $item);
        }
        return Response::json(
            $response
        );
    }
    public function faq(Request $request)
    {
        $this->lang($request);

        $faqList = Faq::all();
        foreach ($faqList as $faq) {
            $faqLists[] =[
                "id"        => $faq->id,
                "title"     => Session::get('app_locale')=='ar'? $faq->question_ar : $faq->question,
                "answer"     => Session::get('app_locale')=='ar'? $faq->answer_ar : $faq->answer,
            ];
        }
        return $this->returnData("faqList",$faqLists,"Successfully");
    }

    public function distributor(Request $request)
    {
        $this->lang($request);
        $validator  = Validator::make((array) $request->all(),
            [
                'car_maker' => 'required|integer',
                'car_model' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $agencyList     = Agency::where('active',1)
        ->whereHas('carMakers', function ($query) use ($request) {
            return $query->where('agency_car_makers.CarMaker_id',$request->car_maker);
        })
        ->whereHas('Car', function ($query)use ($request) {
            return $query->where('cars.CarModel_id',$request->car_model);
        })->get();
        $agencyLists = [];
        foreach ($agencyList as $agency) {
            $agencyLists[] =[
                "image"     => $agency->img->name,
                "name"      => Session::get('app_locale')=='ar'? $agency->name_ar : $agency->name,
                "rate"      => $this->rate($agency),
                "userId"    => $agency->user_id,
                "userType"  => Agency::AgecnyType()[$agency->center_type],
            ];
        }
        return $this->returnData("distributorList",$agencyLists,"Successfully");
    }
    public function governorate(Request $request)
    {
        $this->lang($request);
        $validator  = Validator::make((array) $request->all(),['country_name' => 'required|integer']);
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $governmentList     = Governorate::where('active',1)
        ->where('country_id',$request->country_name)
        ->get();
        $governmentLists = [];
        foreach ($governmentList as $governorate) {
            $governmentLists[] =[
                "id"            => $governorate->id,
                "title"         => Session::get('app_locale')=='ar'? $governorate->title_ar : $governorate->title,
                "country_name"  => Session::get('app_locale')=='ar'? $governorate->country->name_ar : $governorate->country->name,
            ];
        }
        return $this->returnData("governmentList",$governmentLists,"Successfully");
    }
    public function country(Request $request)
    {
        $this->lang($request);

        $countryList     = Country::where('active',1)->get();
        $countryLists = [];
        foreach ($countryList as $country) {
            $countryLists[] =[
                "id"            => $country->id,
                "title"         => Session::get('app_locale')=='ar'? $country->name_ar : $country->name,
                "code"          => $country->code,
                "country_phone" => $country->country_phone,
            ];
        }
        return $this->returnData("countryList",$countryLists,"Successfully");
    }
    public function city(Request $request)
    {
        $this->lang($request);
        $validator  = Validator::make((array) $request->all(),['government_id' => 'required|integer']);
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $cityList     = City::where('active',1)->get();
        $cityLists = [];
        foreach ($cityList as $city) {
            $cityLists[] =[
                "id"            => $city->id,
                "title"         => Session::get('app_locale')=='ar'? $city->title_ar : $city->title,
                "government_id" => $city->governorate_id,
            ];
        }
        return $this->returnData("cityList",$cityLists,"Successfully");
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
    public function rate($agency)
    {
        // Rate Row
        $rate   = AgencyReview::where('agency_id',$agency->id)
        ->selectRaw('SUM(rate)/COUNT(user_id) AS avg_rating')
        ->first()
        ->avg_rating;
        return $rate;
    }
    public function maker(Request $request){
        $this->lang($request);
        $data=new CarMakerCollection(CarMaker::where("active",1)->paginate(10));
        if(!$data->count())
            return $this->errorMessage("No data found");
        return $data;
    }
    public function model(Request $request){
        $this->lang($request);
        if($request->has("car_maker")){
            $data=new CarModelCollection(CarModel::where("active",1)->where("CarMaker_id",$request->car_maker)->paginate(10));
            if(!$data->count())
                return $this->errorMessage("No data found");
            return $data;
        }
        $data=new CarModelCollection(CarModel::where("active",1)->paginate(10));
        if(!$data->count())
            return $this->errorMessage("No data found");
        return $data;
    }
    public function maker_search(Request $request){
        $validator=$this->Validator($request,[
            "word"            => 'required|string',
        ]);
        if (!$validator->fails()) {
            $data=new CarMakerCollection(
                CarMaker::where("active",1)
                ->Where('name', 'LIKE', '%'.$request->word.'%')
                ->paginate(10));
            if(!$data->count())
                return $this->errorMessage("No data found");
            return $data;
        }else {
            return $this->failed($validator);
        }
    }
    public function motor(Request $request){
        $this->lang($request);
        $data=CarCapacityResource::collection(CarCapacity::paginate(10));
        if(!$data->count())
            return $this->errorMessage("No data found");
        return $this->returnData("listMain",$data,"Successfully");
    }
    public function year(Request $request){
        $validator=$this->Validator($request,[
            "car_model"       => 'required|integer',
        ]);
        if (!$validator->fails()) {

            $data=CarYearResource::collection(CarYear::where('CarModel_id',$request->car_model)->get());
            if(!$data->count())
                return $this->errorMessage("No data found");
            return $this->returnData("yearList",$data,"Successfully");
        }else {
            return $this->failed($validator);
        }
    }
    public function model_search(Request $request){
        $validator=$this->Validator($request,[
            "word"            => 'required|string',
            "car_maker"       => 'required|integer',
        ]);
        if (!$validator->fails()) {
            $data=new CarModelCollection(
                CarModel::
                where(function($query)use($request) {
                    return $query->where('active', 1)
                        ->Where('name', 'LIKE',  '%'.$request->word.'%');
                })

                ->orWhere( function($query)use($request) {
                    return $query->where('active', 1)
                        ->Where('CarMaker_id', $request->car_maker);
                })
                ->paginate(10));
            if(!$data->count())
                return $this->errorMessage("No data found");
            return $data;
        }else {
            return $this->failed($validator);
        }
    }

}
