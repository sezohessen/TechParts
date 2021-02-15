<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\api;

use App\Models\Faq;
use App\Models\City;
use App\Models\Agency;
use App\Models\CarYear;
use App\Models\Country;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use App\Models\Governorate;
use App\Models\AgencyReview;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\CarManufacture;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CarYearResource;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\CarMakerCollection;
use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarCapacityResource;
use App\Http\Resources\DistributorCollection;
use App\Http\Resources\GovernorateCollection;
use App\Http\Resources\CarManufactureCollection;
use Illuminate\Support\Facades\Validator as Validator;

class dynamicController extends Controller
{
    use GeneralTrait;


    public function faq(Request $request)
    {
        $this->lang($request->lang);

        $faqList = Faq::all();
        foreach ($faqList as $faq) {
            $faqLists[] = [
                "id"        => $faq->id,
                "title"     => Session::get('app_locale') == 'ar' ? $faq->question_ar : $faq->question,
                "answer"     => Session::get('app_locale') == 'ar' ? $faq->answer_ar : $faq->answer,
            ];
        }
        if (count($faqLists) <= 0) {
            return $this->errorMessage('No Data Found');
        }
        return $this->returnData("faqList", $faqLists, __('Successfully'));
    }

    public function distributor(Request $request)
    {
        $this->lang($request->lang);
        $validator  = Validator::make(
            (array) $request->all(),
            [
                'car_maker' => 'required|integer',
                'car_model' => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $agencyList     = Agency::where('active', 1)
            ->whereHas('carMakers', function ($query) use ($request) {
                return $query->where('agency_car_makers.CarMaker_id', $request->car_maker);
            })
            ->whereHas('Car', function ($query) use ($request) {
                return $query->where('cars.CarModel_id', $request->car_model);
            });
        if ($agencyList->get()->count() <= 0) {
            return $this->errorMessage('No Data Found');
        }
        $data   = new DistributorCollection($agencyList->paginate(10));
        return $data;
    }
    public function governorate(Request $request)
    {
        $this->lang($request->lang);
        $validator  = Validator::make((array) $request->all(), ['country_name' => 'required|integer']);
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $governmentList     = Governorate::where('active', 1)
            ->where('country_id', $request->country_name);
        if ($governmentList->get()->count() <= 0) {
            return $this->errorMessage('No Data Found');
        }
        $data           = new GovernorateCollection($governmentList->paginate(10));
        return $data;
    }
    public function country(Request $request)
    {
        $this->lang($request->lang);

        $countryList    = Country::where('active', 1);
        $data           = new CountryCollection($countryList->paginate(10));
        if (!$data->count())
            return $this->errorMessage("No data found");
        return $data;
    }
    public function city(Request $request)
    {
        $this->lang($request->lang);
        $validator  = Validator::make((array) $request->all(), ['government_id' => 'required|integer']);
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $cityList     = City::where('active', 1)
            ->where('governorate_id', $request->government_id);
        $data           = new CityCollection($cityList->paginate(10));
        if (!$data->count())
            return $this->errorMessage("No data found");
        return $data;
    }

    public function rate($agency)
    {
        // Rate Row
        $rate   = AgencyReview::where('agency_id', $agency->id)
            ->selectRaw('SUM(rate)/COUNT(user_id) AS avg_rating')
            ->first()
            ->avg_rating;
        return $rate;
    }
    public function maker(Request $request)
    {
        $this->lang($request->lang);
        $data = new CarMakerCollection(CarMaker::where("active", 1)->paginate(10));
        if (!$data->count())
            return $this->errorMessage("No data found");
        return $data;
    }
    public function manufactures(Request $request)
    {
        $this->lang($request->lang);
        $data = new CarManufactureCollection(CarManufacture::paginate(10));
        if (!$data->count())
            return $this->errorMessage("No data found");
        return $data;
    }
    public function model(Request $request)
    {
        $this->lang($request->lang);
        if ($request->has("car_maker")) {
            $data = new CarModelCollection(CarModel::where("active", 1)->where("CarMaker_id", $request->car_maker)->paginate(10));
            if (!$data->count())
                return $this->errorMessage("No data found");
            return $data;
        }
        $data = new CarModelCollection(CarModel::where("active", 1)->paginate(10));
        if (!$data->count())
            return $this->errorMessage("No data found");
        return $data;
    }
    public function maker_search(Request $request)
    {
        $validator = $this->Validator($request, [
            "word"            => 'required|string',
        ]);
        if (!$validator->fails()) {
            $data = new CarMakerCollection(
                CarMaker::where("active", 1)
                    ->Where('name', 'LIKE', '%' . $request->word . '%')
                    ->paginate(10)
            );
            if (!$data->count())
                return $this->errorMessage("No data found");
            return $data;
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function motor(Request $request)
    {
        $this->lang($request->lang);
        $data = CarCapacityResource::collection(CarCapacity::paginate(10));
        if (!$data->count())
            return $this->errorMessage("No data found");
        return $this->returnData("listMain", $data, __('Successfully'));
    }
    public function year(Request $request)
    {
        $validator = $this->Validator($request, [
            "car_model"       => 'required|integer',
        ]);
        if (!$validator->fails()) {

            $data = CarYearResource::collection(CarYear::where('CarModel_id', $request->car_model)->get());
            if (!$data->count())
                return $this->errorMessage("No data found");
            return $this->returnData("yearList", $data, __('Successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function model_search(Request $request)
    {
        $validator = $this->Validator($request, [
            "word"            => 'required|string',
            "car_maker"       => 'required|integer',
        ]);
        if (!$validator->fails()) {
            $data = new CarModelCollection(
                CarModel::where(function ($query) use ($request) {
                    return $query->where('active', 1)
                        ->Where('name', 'LIKE',  '%' . $request->word . '%');
                })

                    ->orWhere(function ($query) use ($request) {
                        return $query->where('active', 1)
                            ->Where('CarMaker_id', $request->car_maker);
                    })
                    ->paginate(10)
            );
            if (!$data->count())
                return $this->errorMessage("No data found");
            return $data;
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
}
