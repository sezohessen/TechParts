<?php

namespace App\Http\Controllers\api;
use App\Models\Car;
use App\Models\Agency;
use App\Models\AgencyCar;
use App\Models\UserFav_car;
use App\Models\AgencyReview;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\UserFavAgency;
use App\Classes\Responseobject;
use App\Classes\DataType;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarCollection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator as Validator;

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
            if (!auth()->user()) {
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
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function agency(Request $request)
    {
        $this->lang($request);
        $validator  = $this->home($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id', $request->interest_country)
                ->where('center_type', Agency::center_type_Agency)
                ->paginate();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No Agencies in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData(
                    $agency,
                    $workType = false,
                    $specializationList = false,
                    $badgesList = false,
                    $description = false,
                    $paymentMethodList = false
                );
            }
            return $this->returnData("offersList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function maintenance(Request $request)
    {
        $this->lang($request);
        $validator  = $this->home($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id', $request->interest_country)
                ->where('center_type', Agency::center_type_Maintenance)
                ->paginate();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No maintenance centers in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData(
                    $agency,
                    $workType = false,
                    $specializationList = true,
                    $badgesList = false,
                    $description = false,
                    $paymentMethodList = false
                );
            }
            return $this->returnData("centerList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function spare(Request $request)
    {
        $this->lang($request);
        $validator  = $this->home($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('country_id', $request->interest_country)
                ->where('center_type', Agency::center_type_Spare)
                ->paginate();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No Spare parts centers in this interest country"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData(
                    $agency,
                    $workType = false,
                    $specializationList = true,
                    $badgesList = false,
                    $description = false,
                    $paymentMethodList = false
                );
            }
            return $this->returnData("centerList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function detailsAgency(Request $request)
    {
        $this->lang($request);
        $validator = $this->Details($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id', $request->center_id)
                ->where('center_type', Agency::center_type_Agency)
                ->get();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData(
                    $agency,
                    Agency::AgecnyType()[$agency->agency_type],
                    $specializationList = false,
                    $badgesList = true,
                    $description = true,
                    $paymentMethodList = true
                );
            }
            return $this->returnData("mCenter", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function detailsMaintenance(Request $request)
    {
        $this->lang($request);
        $validator = $this->Details($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id', $request->center_id)
                ->where('center_type', Agency::center_type_Maintenance)
                ->get();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData(
                    $agency,
                    Agency::MaintenanceType()[$agency->maintenance_type],
                    $specializationList = true,
                    $badgesList = true,
                    $description = true,
                    $paymentMethodList = true
                );
            }
            return $this->returnData("mCenter", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function detailsSpare(Request $request)
    {
        $this->lang($request);
        $validator = $this->Details($request);

        if (!$validator->fails()) {
            $agencyList     = Agency::where('id', $request->center_id)
                ->where('center_type', Agency::center_type_Spare)
                ->get();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No such center id exist"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData(
                    $agency,
                    Agency::types()[$agency->center_type],
                    $specializationList = true,
                    $badgesList = true,
                    $description = true,
                    $paymentMethodList = true
                );
            }
            return $this->returnData("mCenter", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function agencySearch(Request $request)
    {
        $this->lang($request);
        $validator = $this->Search($request);

        if (!$validator->fails()) {
            $carStatus      = $request->car_status ? Agency::UsedCar : Agency::NewCar;
            $name           = Session::get('app_locale') == 'ar' ? "name_ar" : "name";
            $agencyList     = Agency::where('country_id', $request->interest_country)
                ->where('center_type', Agency::center_type_Agency)
                ->where('car_status', $carStatus)
                ->where($name, 'like', '%' . $request->word . '%')
                ->paginate();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No centers found"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData(
                    $agency,
                    $workType = false,
                    $specializationList = false,
                    $badgesList = false,
                    $description = false,
                    $paymentMethodList = false,
                    $centerType = false
                );
            }
            return $this->returnData("centerList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function maintenanceSearch(Request $request)
    {
        $this->lang($request);
        $validator = $this->Search($request);

        if (!$validator->fails()) {
            $carStatus      = $request->car_status ? Agency::UsedCar : Agency::NewCar;
            $name           = Session::get('app_locale') == 'ar' ? "name_ar" : "name";
            $agencyList     = Agency::where('country_id', $request->interest_country)
                ->where('center_type', Agency::center_type_Maintenance)
                ->where('car_status', $carStatus)
                ->where($name, 'like', '%' . $request->word . '%')
                ->paginate();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No centers found"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData(
                    $agency,
                    $workType = false,
                    $specializationList = true,
                    $badgesList = false,
                    $description = false,
                    $paymentMethodList = false
                );
            }
            return $this->returnData("centerList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function spareSearch(Request $request)
    {
        $this->lang($request);
        $validator = $this->Search($request);

        if (!$validator->fails()) {
            $carStatus      = $request->car_status ? Agency::UsedCar : Agency::NewCar;
            $name           = Session::get('app_locale') == 'ar' ? "name_ar" : "name";
            $agencyList     = Agency::where('country_id', $request->interest_country)
                ->where('center_type', Agency::center_type_Spare)
                ->where('car_status', $carStatus)
                ->where($name, 'like', '%' . $request->word . '%')
                ->paginate();
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No centers found"));
            }
            $agencies = [];
            foreach ($agencyList as $agency) {
                $agencies[]     = $this->AgencyData($agency, $workType = false, $specializationList = true, $badgesList = false, $paymentMethodList = false, $centerType = false);
            }
            return $this->returnData("centerList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function agencyFav(Request $request)
    {
        $this->lang($request);
        $validator = $this->Favorite($request, 'agency');

        if (!$validator->fails()) {
            if (!auth()->user()) {
                return $this->errorMessage(__('Login to see your favorite'));
            }

            if (!auth()->user()->agencyFav->count()) {
                return $this->returnSuccess(__("No centers found"));
            }
            $agencyList = auth()->user()->agencyFav;
            foreach ($agencyList as $agency) {

                $agencies[]     = $this->AgencyData(
                    $agency,
                    $workType = false,
                    $specializationList = false,
                    $badgesList = false,
                    $description = false,
                    $paymentMethodList = false,
                    $centerType = false,
                    $mContact = false,
                    $mLocation = false,
                    $carMakerList = false
                );
            }
            return $this->returnData("agencyList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function centerFav(Request $request)
    {
        $this->lang($request);
        $validator = $this->Favorite($request, 'center');

        if (!$validator->fails()) {
            if (!auth()->user()) {
                return $this->errorMessage(__('Login to see your favorite'));
            }

            if (!auth()->user()->MaintenanceFav->count()) {
                return $this->returnSuccess(__("No centers found"));
            }
            $agencyList = auth()->user()->agencyFav;
            foreach ($agencyList as $agency) {

                $agencies[]     = $this->AgencyData(
                    $agency,
                    $workType = false,
                    $specializationList = false,
                    $badgesList = false,
                    $description = false,
                    $paymentMethodList = false,
                    $centerType = false,
                    $mContact = false,
                    $mLocation = false,
                    $carMakerList = false
                );
            }
            return $this->returnData("maintenanceList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function addFav(Request $request)
    {
        $this->lang($request);
        if ($request->favorite_type == 'agency') {
            $validator = $this->Favorite($request, 'agency', 1);
        } elseif ($request->favorite_type == 'center') {
            $validator = $this->Favorite($request, 'center', 1);
        } elseif ($request->favorite_type == 'car') {
            $validator = $this->Favorite($request, 'car', 1);
        } else {
            return $this->errorMessage(__('Favorite type invalid'));
        }

        if (!$validator->fails()) {
            if (!auth()->user()) {
                return $this->errorMessage(__('Login to see your favorite'));
            }
            if ($request->favorite_type == 'agency' || $request->favorite_type == 'center') { //Add Agency&Center Favorite
                $agencyFav  = UserFavAgency::where('user_id', auth()->user()->id)
                    ->where('agency_id', $request->target_id)
                    ->first();
                $isFound    = Agency::find($request->target_id);
                if ($agencyFav) {
                    return $this->errorMessage(__('This Favorite type is already exist'));
                } elseif (!$isFound) {
                    return $this->errorMessage(__('Target id does not exist'));
                } else {
                    $agencyFav  = UserFavAgency::create([
                        'agency_id'     => $request->target_id,
                        'user_id'       => auth()->user()->id
                    ]);
                    return $this->returnSuccess(__("Successfully added to Favorite"));
                }
            } elseif ($request->favorite_type == 'car') { //car Favorite
                $carFav  = UserFav_car::where('user_id', auth()->user()->id)
                    ->where('car_id', $request->target_id)
                    ->first();
                $isFound    = Car::find($request->target_id);
                if ($carFav) {
                    return $this->errorMessage(__('This Favorite type is already exist'));
                } elseif (!$isFound) {
                    return $this->errorMessage(__('Target id does not exist'));
                } else {
                    $carFav  = UserFav_car::create([
                        'car_id'        => $request->target_id,
                        'user_id'       => auth()->user()->id
                    ]);
                    return $this->returnSuccess(__("Successfully added to Favorite"));
                }
            } else {
                return $this->returnSuccess(__("Something went wrong"));
            }
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function removeFav(Request $request)
    {
        $this->lang($request);
        if ($request->favorite_type == 'agency') {
            $validator = $this->Favorite($request, 'agency', 1);
        } elseif ($request->favorite_type == 'center') {
            $validator = $this->Favorite($request, 'center', 1);
        } elseif ($request->favorite_type == 'car') {
            $validator = $this->Favorite($request, 'car', 1);
        } else {
            return $this->errorMessage(__('Favorite type invalid'));
        }

        if (!$validator->fails()) {
            if (!auth()->user()) {
                return $this->errorMessage(__('Login to see your favorite'));
            }
            if ($request->favorite_type == 'agency' || $request->favorite_type == 'center') { //Add Agency&Center Favorite
                $agencyFav  = UserFavAgency::where('user_id', auth()->user()->id)
                    ->where('agency_id', $request->target_id)
                    ->first();
                if (!$agencyFav) {
                    return $this->errorMessage(__('There is not favorite to be deleted'));
                } else {
                    $agencyFav->delete();
                    return $this->returnSuccess(__("Successfully Removed"));
                }
            } elseif ($request->favorite_type == 'car') { //car Favorite
                $carFav  = UserFav_car::where('user_id', auth()->user()->id)
                    ->where('car_id', $request->target_id)
                    ->first();
                if (!$carFav) {
                    return $this->errorMessage(__('There is not favorite to be deleted'));
                } else {
                    $carFav->delete();
                    return $this->returnSuccess(__("Successfully Removed"));
                }
            } else {
                return $this->returnSuccess(__("Something went wrong"));
            }
        } else {
            return ($this->ValidatorErrors($validator));
        }
    }
    public function Filter(Request $request)
    {
        $this->lang($request);
        $validator = $this->FilterValidate($request);

        if (1) {
            $carStatus      = $request->car_state == 'new' ? Agency::NewCar : Agency::UsedCar;
            $center_type    = $request->work_type == 'agency' ? Agency::center_type_Agency : (($request->work_type == 'maintenance') ? Agency::center_type_Maintenance : Agency::center_type_Spare);
            $agencyList     = Agency::where('country_id', $request->interest_country)
                ->where('active', 1)
                ->where('car_status', $carStatus);
            /*->whereHas('carMakers', function ($query) use ($request) {
                return $query->where('agency_car_makers.CarMaker_id',$request->car_maker_id);
            })
            ->whereHas('Car', function ($query)use ($request) {
                return $query->where('cars.CarModel_id',$request->car_model_id);
            }); */
            if ($request->work_type) $agencyList->where('center_type', $center_type);
            if ($request->badge_ids) $agencyList->whereIn('status', [$request->badge_ids]);
            if ($request->payment_methods) $agencyList->whereIn('payment_method', [$request->payment_methods]);

            /* if($request->sort_rate =='high'){
                $agencyList->whereHas('reviews', function ($query) use ($request) {
                    $query->selectRaw('SUM(rate)/COUNT(agency_id) AS avg_rating');
                });
            }elseif($request->sort_rate =='low'){

            } */
            if ($request->sort_added == 'recent') $agencyList->orderBy('created_at', 'desc');
            /* if (isset($request->sort_near_by_lat) && isset($request->sort_near_by_lng)) { //Filter by location
                $agencyList->orderBy(DB::raw(
                    'ST_DISTANCE_SPHERE(Point(latitude, longitude), Point(?, ?))',
                    [$request->sort_near_by_lat, $request->sort_near_by_lng]
                ), 'desc');
            } */
            if (!$agencyList->count()) {
                return $this->returnSuccess(__("No centers found"));
            }
            $agencies = [];
            foreach ($agencyList->get() as $agency) {
                $agencies[]     = $this->AgencyData($agency, $workType = false, $specializationList = false, $badgesList = false, $description = false, $paymentMethodList = false, $centerType = true);
            }
            return $this->returnData("centerList", $agencies, "Successfully");
        } else {
            return ($this->ValidatorErrors($validator));
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

        if ($agency->AgencyContact) {
            $mContact = [
                "face"          => $agency->AgencyContact->facebook,
                "instagram"     => $agency->AgencyContact->instagram,
                "messenger"     => $agency->AgencyContact->messenger,
                "phone"         => $agency->user->phone, //May be i will edit this
                "whats"         => $agency->AgencyContact->whatsapp,
            ];
        }
        return $mContact;
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
    public function Location($agency)
    {
        // mLocation Row
        $mLocation = [
            "city_name"         => Session::get('app_locale') == 'ar' ? $agency->city->title_ar : $agency->city->title,
            "government_name"   => Session::get('app_locale') == 'ar' ? $agency->governorate->title_ar : $agency->governorate->title,
            "latitude"          => $agency->lat,
            "longitude"         => $agency->long,
        ];

        return $mLocation;
    }
    public function carMakerList($agency)
    {
        // Car Maker Row
        $carMakerList       = [];
        if ($agency->carMakers) {
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
    public function specializationList($agency)
    {
        // specializationList
        $specializationList = [];
        if ($agency->agency_specialties) {
            foreach ($agency->agency_specialties as $list) {
                $specializationList[]   = Session::get('app_locale') == 'ar' ? $list->name_ar : $list->name;
            }
        }
        return $specializationList;
    }
    public function lang($request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en'])) {
                default_lang($locale);
            } else {
                default_lang();
            }
        } else {
            default_lang();
        }
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
    public function Validator($request,$rules,$niceNames=[])
    {
        $this->lang( $request);
        return Validator::make($request->all(),$rules,[],$niceNames);
    }
    public function ValidatorErrors($validator)
    {
        $response           = new Responseobject();       # $response->status   = $response::status_failed;
        $response->code     = $response::code_failed;
        foreach ($validator->errors()->getMessages() as $item) {
            array_push($response->msg, $item);
        }
        return Response::json(
            $response
        );
    }
    public function AgencyData(
        $agency,
        $workType = 1,
        $specializationList = 1,
        $badgesList = 1,
        $description = 1,
        $paymentMethodList = 1,
        $centerType = 1,
        $mContact = 1,
        $mLocation = 1,
        $carMakerList = 1
    ) //Power Full Function :P
    {
        list($Max, $Min)             = $this->PriceRange($agency);
        $agencies = [
            "centerType"            => Agency::types()[$agency->center_type],
            "id"                    => $agency->id,
            "logo"                  => find_image(@$agency->img),
            "title"                 => Session::get('app_locale') == 'ar' ? $agency->name_ar : $agency->name,
            "description"           => Session::get('app_locale') == 'ar' ? $agency->description_ar : $agency->description,
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
        if (!$specializationList) unset($agencies["specializationList"]);
        if (!$workType) unset($agencies["workType"]);
        if (!$badgesList) unset($agencies["badgesList"]);
        if (!$specializationList) unset($agencies["specializationList"]);
        if (!$description) unset($agencies["description"]);
        if (!$paymentMethodList) unset($agencies["paymentMethodList"]);
        if (!$centerType) unset($agencies["centerType"]);
        if (!$mContact) unset($agencies["mContact"]);
        if (!$mLocation) unset($agencies["mLocation"]);
        if (!$carMakerList) unset($agencies["carMakerList"]);
        return $agencies;
    }
    public function Search($request)
    {
        $data       = $request->all();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer', //Will be updated
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
    public function Favorite($request, $type, $id = NULL)
    {
        $data       = $request->all();

        $array_data = (array)$data;
        if ($id) {
            $validator  = Validator::make($array_data, [
                'token'             => 'required',
                'target_id'         => 'required|integer',
                'favorite_type'     => 'required|in:' . $type,
            ]);
        } else {
            $validator  = Validator::make($array_data, [
                'token'             => 'required',
                'favorite_type'     => 'required|in:' . $type,
            ]);
        }
        return $validator;
    }
    public function FilterValidate($request)
    {
        $data       = $request->all();

        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'      => 'required|integer',
            'token'                 => 'nullable',
            'car_state'             => 'required|in:new,used',
            'car_maker_id'          => 'required|integer',
            'car_model_id'          => 'required|integer',
            'car_model_id'          => 'required|integer',
            'year'                  => 'nullable|integer',
            'badge_ids'             => 'nullable|array|max:3',
            "badge_ids.*"           => "nullable|integer|distinct|in:0,1,2",
            'work_type'             => 'nullable|in:agency,maintenance,spare',
            'payment_methods'       => 'nullable|array|max:3',
            'payment_methods.*'     => 'nullable|string|distinct|in:cash,installment,financing',
            'sort_added'            => 'nullable|in:recent,trending',
            'sort_rate'             => 'nullable|in:high,low',
            'sort_price'            => 'nullable|in:high,low',
            'sort_near_by_lat'      => 'nullable|string',
            'sort_near_by_lng'      => 'nullable|string',

        ]);
        return $validator;
    }
    public function carFav(Request $request){
        $validator=$this->Validator($request,[
            "favorite_type"            => 'required|string|in:car',
        ]);
        if (!$validator->fails()) {
            $user=Auth()->user();
            $cars=$user->AuthFavCar()->get();
            if(!$cars->count())
                return $this->errorMessage('Favorite cars are empty');
            $type   = new DataType();
            $data=(new CarCollection($cars))->type($type::list);
            return $data;
        }else {
            return $this->failed($validator);
        }

    }
    public function FavList(Request $request){
        $validator=$this->Validator($request,[
            "favorite_type"            => 'required|string',
        ]);
        if (!$validator->fails()) {
            if ($request->favorite_type == 'agency') {
                return $this->agencyFav($request);
            }elseif ($request->favorite_type == 'center') {
                return $this->centerFav($request);
            }elseif ($request->favorite_type == 'car') {
                return $this->carFav($request);
            }else{
                return $this->errorMessage(__('Favorite type invalid'));
            }
        }else {
            return $this->failed($validator);
        }

    }
}
