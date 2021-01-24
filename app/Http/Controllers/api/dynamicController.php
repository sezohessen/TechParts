<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;
use App\Classes\Responseobject;
use App\Models\Agency;
use App\Models\AgencyReview;
use App\Models\Faq;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;

class dynamicController extends Controller
{
    use GeneralTrait;
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
        });

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
}
