<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;

use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator as Validator;

use App\Classes\DataType;
use App\Models\Agency;
use App\Models\AgencyCar;
use App\Models\AgencyReview;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\MyMaintenanceList;
use App\Models\Trending;
use App\Models\UserFavAgency;
use Illuminate\Http\Request;

class HomeDataController extends Controller
{

    use GeneralTrait;
    public function completeData(Request $request)
    {
        $this->lang($request->lang);

        $validator      = Validator::make((array) $request->all(), ['interest_country' => 'required|integer']);
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $agencyList     = Agency::where('center_type', Agency::center_type_Agency)->where('country_id', $request->interest_country)
            ->where('show_in_home', 1)
            ->get();

        if (!$agencyList->count()) {
            return $this->errorMessage(__("No Agencies in this interest country"));
        }
        $agencies = [];
        foreach ($agencyList as $agency) {
            list($Max, $Min)     = $this->PriceRange($agency);
            $agencies[]     = [
                "centerType"    => Agency::ApiType()[$agency->center_type],
                "id"            => $agency->id,
                "isAuthorised"  => $agency->is_authorised ? true : false,
                "isFavorite"    => $this->isFav($agency),
                "image"         => find_image(@$agency->img),
                "logo"          => find_image(@$agency->logo),
                "priceRangeMax" => $Max,
                "priceRangeMin" => $Min,
                "title"         => Session::get('app_locale') == 'ar' ? $agency->name_ar : $agency->name,
                "rate"          => $this->rate($agency),
            ];
        }
        $user = auth('sanctum')->user();
        /*
        foreach ($user->tokens as $token) {
            $token->delete();
        }
        dd($user->currentAccessToken()->plainTextToken);*/
        if ($user) {
            $token = null;
            $headers = apache_request_headers();
            if (isset($headers['Authorization'])) {
                if (strpos($headers['Authorization'], 'Bearer') !== false) {
                    $token = str_replace('Bearer ', '', $headers['Authorization']);
                }
            }
            $user_data = [
                "country_code"      => $user->country_code,
                "country_number"    => $user->country_phone,
                "email"             => $user->email,
                "first_name"        => $user->first_name,
                "image"             => find_image(@$user->image),
                "is_phone_verified" => $user->is_phone_virefied ? true : false,
                "last_name"         => $user->last_name,
                "phone"             => $user->phone,
                "role_id"           => $user->role ? $user->role->first()->name : 'user',
                "token"             => $token,
                "userId"            => $user->id
            ];
            if ($user->interestCountry) {
                $data["interest_country"] =  $user->interestCountry->id;
            }
        } else {
            $user_data = null;
        }


        $trendingCarList     = Trending::where('day', date("Y-m-d"))->first();
        $trendingCars = [];
        if ($trendingCarList) {
            if ($trendingCarList->trends) {
                foreach ($trendingCarList->trends as $car) {
                    $car            = $car;
                    $type           = new DataType();
                    $trendingCars[]   = (new CarResource($car))->type($type::list);
                }
            }
        }
        $array_data = [];
        if ($user_data) {
            $array_data['mUser'] = $user_data;
        }
        if ($trendingCars) {
            $array_data['trendingCarList'] = $trendingCars;
        }
        if (empty($agencies)) {
            return $this->errorMessage('No Data Found');
        }
        return $this->returnData("agencyList", $agencies, "Success", $array_data);
    }
    public function createNewMaintenance(Request $request)
    {
        $this->lang($request->lang);
        $validator      = Validator::make(
            (array) $request->all(),
            [
                'car_maker_id'      => 'required|integer',
                'car_model_id'      => 'required|integer',
                'date_next'         => 'required|date',
            ]
        );
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        if (!auth()->user()) {
            return $this->errorMessage(__('Login to create new maintenance'));
        }
        $car_maker_id   = CarMaker::find($request->car_maker_id);
        if (!$car_maker_id) {
            return $this->errorMessage(__("No such car maker id exist"));
        }
        $car_model_id   = CarModel::find($request->car_model_id);
        if (!$car_model_id) {
            return $this->errorMessage(__("No such car model id exist"));
        }
        $lastList       = MyMaintenanceList::where('CarMaker_id', $request->car_maker_id)
            ->where('CarModel_id', $request->car_model_id)
            ->where('date_next', $request->date_next)
            ->get();
        if ($lastList->count()) {
            return $this->errorMessage(__("This maintenance list already exist"));
        }

        $MyMaintenanceList  = MyMaintenanceList::create([
            'date_next'     => $request->date_next,
            'CarMaker_id'   => $request->car_maker_id,
            'CarModel_id'   => $request->car_model_id,
            'user_id'       => auth()->user()->id
        ]);
        $mCarMaker  = [
            "id"        => $car_maker_id->id,
            "logo"      => $car_maker_id->logo->name,
            "title"     => $car_maker_id->name
        ];
        $mCarModel  = [
            "car_maker_id"  => $car_model_id->CarMaker_id,
            "id"            => $car_model_id->id,
            "title"         => $car_model_id->name
        ];
        $myMaintenance  = [
            "date_next"     => $MyMaintenanceList->date_next,
            "id"            => $MyMaintenanceList->id,
            "mCarMaker"     => $mCarMaker,
            "mCarModel"     => $mCarModel
        ];
        return $this->returnData("myMaintenance", $myMaintenance, __("Created Successfully"));
    }
    public function get_list(Request $request)
    {
        $this->lang($request->lang);

        if (!auth()->user()) {
            return $this->errorMessage(__('Login to show maintenance list'));
        }

        $Mylist       = MyMaintenanceList::where('user_id', auth()->user()->id)->get();
        $MaintenanceList = [];
        $forSuggest      = [];
        foreach ($Mylist as $MainList) {
            $car_maker_id   = CarMaker::find($MainList->CarMaker_id);
            $car_model_id   = CarModel::find($MainList->CarModel_id);
            $forSuggest[]   = $MainList->CarMaker_id;
            $mCarMaker  = [
                "id"        => $car_maker_id->id,
                "logo"      => $car_maker_id->logo->name,
                "title"     => $car_maker_id->name
            ];
            $mCarModel  = [
                "car_maker_id"  => $car_model_id->CarMaker_id,
                "id"            => $car_model_id->id,
                "title"         => $car_model_id->name
            ];
            $MaintenanceList[]  = [
                "date_next"     => $MainList->date_next,
                "id"            => $MainList->id,
                "mCarMaker"     => $mCarMaker,
                "mCarModel"     => $mCarModel
            ];
        }

        if ($Mylist->count()) {
            $agencyList     = Agency::where('center_type', Agency::center_type_Maintenance)->whereHas('carMakers', function ($query) use ($forSuggest) {
                return $query->whereIn('agency_car_makers.CarMaker_id', $forSuggest)->take(5);
            });
            $agencyList = $agencyList->get();
        } else {
            $agencyList     = Agency::where('active', 1)->where('center_type', Agency::center_type_Maintenance)->get()->random(5);
        }
        $agencies   = [];

        foreach ($agencyList as $agency) {
            list($Max, $Min)     = $this->PriceRange($agency);
            $agencies[]     = [
                "centerType"    => Agency::ApiType()[$agency->center_type],
                "id"            => $agency->id,
                "isAuthorised"  => $agency->is_authorised ? true : false,
                "isFavorite"    => $this->isFav($agency),
                "image"         => find_image(@$agency->img),
                "logo"          => find_image(@$agency->logo),
                "priceRangeMax" => $Max,
                "priceRangeMin" => $Min,
                "title"         => Session::get('app_locale') == 'ar' ? $agency->name_ar : $agency->name,
                "rate"          => $this->rate($agency),
            ];
        };
        return $this->returnData("myMaintenanceList", $MaintenanceList, __("Successfully"), ["suggestedCenterList"   => $agencies]);
    }

    public function isFav($agency)
    {
        // Favorite Row
        $isFavorite = false;
        if (auth()->user()) {
            $fav    = UserFavAgency::where('agency_id', $agency->id)
                ->where('user_id', auth()->user()->id)
                ->first();
            if ($fav) {
                $isFavorite = true;
            }
        }
        return $isFavorite;
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
    public function PriceRange($agency)
    {
        // Price Row
        $agencyCars     = AgencyCar::where('agency_id', $agency->id)->get();
        $Max = 0;
        $Min = 100000000;
        foreach ($agencyCars as $agencyCar) {
            $price = $agencyCar->car->price;
            if ($price > $Max) {
                $Max = $price;
            }
            if ($price < $Min) {
                $Min = $price;
            }
        }
        if (!$agencyCars->count()) {
            $Max = 0;
            $Min = 0;
        }
        return array($Max, $Min);
    }
}
