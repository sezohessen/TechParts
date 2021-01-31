<?php

namespace App\Http\Controllers\api;

use Exception;

use App\Models\Car;
use App\Models\City;
use App\Models\User;
use App\Models\Alert;
use App\Models\Image;
use App\Models\Badges;
use App\Models\car_img;
use App\Models\CarBody;
use App\Models\CarYear;
use App\Models\Country;
use App\Models\Feature;

use App\Models\CarColor;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\car_badge;
use App\Models\PromoteCar;
use App\Models\car_deposit;
use App\Models\car_feature;
use App\Models\CarCapacity;
use App\Models\Governorate;
use App\Models\ListCarUser;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\CarManufacture;
use App\Classes\DataType;
use function PHPSTORM_META\type;
use App\Models\subscribe_package;
use App\Http\Resources\CarResource;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CarCollection;
use Illuminate\Support\Facades\Session;

use App\Http\Resources\SubscribeResource;
use Illuminate\Support\Facades\Validator as Validator;

class CarsController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function Validator($request, $rules, $niceNames = [])
    {
        $this->lang($request->lang);
        return Validator::make($request->all(), $rules, [], $niceNames);
    }
    public function details(Request $request)
    {
        $validator = $this->Validator($request, [
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if (!$car = Car::find($request->car_id)) {
                return $this->errorMessage('Car not found');
            }
            $type   = new DataType();
            $data = (new CarResource($car))->type($type::single);
            return  $this->returnData('mCar', $data, __('Successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }


    public function search(Request $request)
    {

        $validator = $this->Validator($request, [
            "interest_country" => 'required|integer',
            "car_status"       => 'required|integer|between:0,1',
            "word"             => 'required|string|max:255',
        ]);
        if (!$validator->fails()) {
            $status = ($request->car_status == 1) ? Car::IS_USED : Car::IS_NEW;
            if (!$country = Country::find($request->interest_country)) {
                return $this->errorMessage('Country not found');
            }
            $type   = new DataType();
            $data = (new CarCollection(
                Car::where("status", 1)
                    ->where('IsNew', '=', $status)
                    ->where('Country_id', $country->id)
                    ->WhereHas('maker', function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->word . '%');
                    })
                    ->paginate(10)
            ))->type($type::list);
            if (!$data->count())
                return $this->errorMessage("No data found");
            return $data;
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function stop($car)
    {
        if (!$car->count()) {
            return true;
        }
    }
    public function filter(Request $request)
    {
        $validator = $this->Validator($request, [
            "interest_country"         => 'required|integer',
            "car_state"                => 'required|integer|between:0,1',
            "car_maker_id"             => 'required|integer',
            "car_model_id"             => 'required|integer',
            "year"                     => 'nullable|integer',
            "price_min"                => 'nullable|integer',
            "price_max"                => 'nullable|integer',
            "kilometers_min"           => 'nullable|integer',
            "kilometers_max"           => 'nullable|integer',
            "body_style_id"            => 'nullable|integer',
            "badge_id"                 => 'nullable|integer',
            "extra_feature_id"         => 'nullable|integer',
            "transmission"            => 'nullable|between:0,1',
            "color"                    => 'nullable|integer',
            "location_government_id"    => 'nullable|integer',
            "location_city_id"         => 'nullable|integer',
            "seller_type"              => 'nullable|between:0,2',
            "is_accident"              => 'nullable|between:0,1',
            "payment_method"           => 'nullable|between:0,2',
            "sort_added"               => 'nullable|in:recent,trending',
            "sort_kilometer"           => 'nullable|in:low,high',
            "sort_year"                => 'nullable|in:low,high',
            "sort_price"               => 'nullable|in:low,high',
            "sort_near_by_lat"         => 'nullable|numeric',
            "sort_near_by_lng"         => 'nullable|numeric',

        ]);
        if (!$validator->fails()) {

            $car = Car::where("status", 1);


            $car->where("Country_id", $request->interest_country)
                ->where("isNew", $request->car_state)
                ->where("CarMaker_id", $request->car_maker_id)
                ->where("CarModel_id", $request->car_model_id);
            if ($this->stop($car)) {

                return $this->errorMessage("No data found");
            }

            if ($request->has("year")) {
                $car->where('CarYear_id', $request->year);
            }

            if ($request->has("price_min") && $request->has("price_max")) {
                $car->whereBetween('price', [$request->price_min, $request->price_max]);
            }
            if ($request->has("kilometers_min")  && $request->has("kilometers_max")) {
                $car->whereBetween('kiloUsed', [(int)$request->kilometers_min, (int)$request->kilometers_max]);
            }
            if ($request->has("body_style_id")) {
                $car->where('CarBody_id', $request->body_style_id);
            }
            if ($this->stop($car)) {

                return $this->errorMessage("No data found");
            }

            if ($request->has("extra_feature_id")) {
                $cars = $car;
                foreach ($cars->get() as $item) {
                    if (!$item->features->where("feature_id", $request->extra_feature_id)->count()) {
                        $car->where("cars.id", '!=', $item->id);
                    }
                }
            };
            if ($this->stop($car)) {

                return $this->errorMessage("No data found");
            }
            if ($request->has('transmission')) {
                $car->where("transmission", $request->transmission);
            }

            if ($request->has('color')) {
                $car->where("CarColor_id", $request->color);
            }
            if ($request->has('location_government_id')) {
                $car->where("Governorate_id", $request->location_government_id);
            }
            if ($request->has('location_city_id')) {
                $car->where("City_id", $request->location_city_id);
            }
            if ($request->has('seller_type')) {
                $car->where("SellerType", $request->seller_type);
            }

            if ($request->has('is_accident')) {
                $car->where("AccidentBefore", $request->is_accident);
            }
            if ($request->has('payment_method')) {
                $car->where("payment", $request->payment_method);
            }
            if ($this->stop($car)) {
                return $this->errorMessage("No data found");
            }
            if ($request->has('sort_kilometer')) {
                if ($request->sort_kilometer == 'low') {
                    $car->orderBy('kiloUsed', 'ASC');
                } else {
                    $car->orderBy('kiloUsed', 'DESC');
                }
            }

            if ($request->has('sort_price')) {
                if ($request->sort_price == 'low') {
                    $car->orderBy('price', 'ASC');
                } else {
                    $car->orderBy('price', 'DESC');
                }
            }
            if ($request->has("sort_near_by_lat")  && $request->has("sort_near_by_lng")) {
                $cars = $car;
                foreach ($cars->get() as $item) {
                    $check = distance($request->sort_near_by_lat, $request->sort_near_by_lng, $item->lat, $item->lng, "K");
                    if ($check > d_constent()) {
                        $car->where("cars.id", '!=', $item->id);
                    }
                }
            }

            if ($request->has('sort_added') &&  $request->sort_added == 'recent') {
                $car->orderBy('created_at', 'DESC');
            }
            if ($request->has('sort_added') &&  $request->sort_added == 'trending') {
                $cars = $car;
                foreach ($cars->get() as $item) {
                    if (!$item->trends->where("car_id", $item->id)->count()) {
                        $car->where("cars.id", '!=', $item->id);
                    }
                }
            }
            if ($request->has('sort_year')) {
                if ($request->sort_year == 'low') {
                    // $car->sortBy(function($query){
                    //   return $query->year->year;
                    // });
                    //$car->join('car_years','car_years.id','=','cars.CarYear_id')
                    //->orderBy('car_years.year','ASC');

                } else {
                    // $car->sortByDesc(function($query){
                    //     return $query->year->year;
                    // });
                    //$car->join('car_years','car_years.id','=','cars.CarYear_id')
                    //->orderBy('car_years.year','DESC');
                }
            }
            $type   = new DataType();
            $data = (new CarCollection($car->paginate(10)))->type($type::list);
            if (!$data->count())
                return $this->errorMessage("No data found");
            return $data;
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function deposit(Request $request)
    {

        $validator = $this->Validator($request, [
            "car_id"            => 'required|integer',
            "price"             => 'required|integer',
            "weaccept_order_id" => 'required',
        ], [
            'weaccept_order_id' => __('Order ID'),
        ]);
        if (!$validator->fails()) {
            if (!$car = Car::find($request->car_id)) {
                return $this->errorMessage('Car not found');
            }
            car_deposit::create([
                'user_id' => Auth()->user()->id,
                'car_id' => $car->id,
                'price' => $request->price,
                'weaccept_order_id' => $request->weaccept_order_id
            ]);
            $type   = new DataType();
            $data = (new CarResource($car))->type($type::list);
            return  $this->returnData('mCar', $data, __('Deposit Successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function alert(Request $request)
    {
        $validator = $this->Validator($request, [
            "car_id"            => 'required|integer',
            "status"             => 'required|integer|between:0,1',
        ]);
        if (!$validator->fails()) {
            if (!$car = Car::find($request->car_id)) {
                return $this->errorMessage('Car not found');
            }
            $alert = Alert::where("car_id", $request->car_id)->where("user_id", Auth()->id())->update([
                "status" => $request->status
            ]);
            if (!$alert) {
                Alert::create([
                    "car_id" => $request->car_id,
                    "user_id" => Auth()->id(),
                    "status" => $request->status
                ]);
            }
            return  $this->returnSuccess(__('Success change Status of car'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function compare(Request $request)
    {
        $validator = $this->Validator($request, [
            "car_id_01"            => 'required|integer',
            "car_id_02"             => 'required|integer|different:car_id_01',
        ], [
            'car_id_01' => __('First Car ID'),
            'car_id_02' => __('Second Car ID'),
        ]);
        if (!$validator->fails()) {
            if (!$first_car = Car::find($request->car_id_01)) {
                return $this->errorMessage('First Car ID not found');
            }
            if (!$second_car = Car::find($request->car_id_02)) {
                return $this->errorMessage('Second Car ID not found');
            }
            $type   = new DataType();
            $data = (new CarCollection(Car::find([$request->car_id_01, $request->car_id_02])))
                ->type($type::compare);
            return  $data;
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function action_counter(Request $request)
    {
        $validator = $this->Validator($request, [
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if (!$car = Car::find($request->car_id)) {
                return $this->errorMessage('First Car ID not found');
            }
            $car->update(["views" => $car->views + 1]);
            return  $this->returnSuccess(__('Car views has been increment successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function promote_package(Request $request)
    {
        $this->lang($request->lang);
        $package = SubscribeResource::collection(subscribe_package::all());
        if (!$package->count())
            return $this->errorMessage("No data found");
        return  $this->returnData('packageList', $package, __('Successfully get Subscribed Packages'));
    }
    public function promote(Request $request)
    {

        $validator = $this->Validator($request, [
            "car_id"               => 'required|integer',
            "subscribe_package_id" => 'required|integer',
            "price"                => 'required|integer',
            "weaccept_order_id"    => 'required',
        ]);
        if (!$validator->fails()) {
            if (!$car = Car::find($request->car_id)) {
                return $this->errorMessage('First Car ID not found');
            } elseif (!$subscribe_package = subscribe_package::find($request->subscribe_package_id)) {
                return $this->errorMessage('Subscribe Package  ID not found');
            }
            if ($car->promotedStatus) {
                $car->update([
                    "promotedExpire" => date("Y-m-d", strtotime("+" . $subscribe_package->period . "month", strtotime($car->promotedExpire))),
                    'promotedStatus' => true
                ]);
            } else {
                $car->update([
                    "promotedExpire" => date("Y-m-d", strtotime("+" . $subscribe_package->period . "month", strtotime($car->adsExpire))),
                    'promotedStatus' => true
                ]);
            }
            PromoteCar::create([
                "car_id" => $car->id,
                "subscribe_package_id" => $subscribe_package->id,
                "user_id" => Auth()->user()->id,
                "price" => $request->price,
                "weaccept_order_id" => $request->weaccept_order_id
            ]);
            $type   = new DataType();
            $data = (new CarResource($car))->type($type::promote);
            return  $this->returnData('mCar', $data, __('Promoted Successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function copy(Request $request)
    {
        $validator = $this->Validator($request, [
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if (!$car = Car::find($request->car_id)) {
                return $this->errorMessage('Car ID not found');
            }
            unset($car['adsExpire']);
            $car['views'] = 0;
            $new_car = $car->replicate();
            $new_car->save();
            $auth = (auth('sanctum')->user()) ? auth('sanctum')->id() : $new_car->user->id;
            $CarPhotos = car_img::where('car_id', '=', $car->id)->get();
            foreach ($CarPhotos as $key => $img) {
                car_img::create([
                    'car_id' => $new_car->id,
                    'img_id' => $img->img_id
                ]);
            }
            $CarBadges = car_badge::where('car_id', '=', $car->id)->get();
            foreach ($CarBadges as $key => $badge) {
                car_badge::create([
                    'car_id' => $new_car->id,
                    'badge_id' => $badge->badge_id
                ]);
            }
            $CarFeatures = car_feature::where('car_id', '=', $car->id)->get();
            foreach ($CarFeatures as $key => $feature) {
                car_feature::create([
                    'car_id' => $new_car->id,
                    'feature_id' => $feature->feature_id
                ]);
            }
            ListCarUser::create([
                "user_id" => $auth,
                "car_id" => $new_car->id
            ]);
            $car = Car::find($new_car->id);
            $car->update([
                'user_id' => $auth,
                'status' => Car::STATUS_DISABLE
            ]);
            $type   = new DataType();
            $data = (new CarResource($car))->type($type::single);
            return  $this->returnData('mCar', $data, __('Successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function delete(Request $request)
    {
        $validator = $this->Validator($request, [
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if (!$car = Car::find($request->car_id)) {
                return $this->errorMessage('Car ID not found');
            }
            $images = car_img::where("car_id", $car->id)->get();
            Car::unlink_img($images);
            $CarBadges = car_badge::where('car_id', '=', $car->id)->get();
            foreach ($CarBadges as $key => $badge) {
                $badge->delete();
            }
            $CarFeatures = car_feature::where('car_id', '=', $car->id)->get();
            foreach ($CarFeatures as $key => $feature) {
                $feature->delete();
            }
            $car->delete();
            return  $this->returnSuccess(__('Deleted successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function create(Request $request)
    {


        $validator = $this->Validator($request, $this->rules());
        if (!$validator->fails()) {

            $check = $this->checkMultipleImage($request->imageList);
            if (!$check) {
                return $this->errorMessage('wrong images');
            }

            if (CarMaker::where("active", 1)->find($request->carMaker)) {
                if (CarModel::where("active", 1)->where("CarMaker_id", $request->carMaker)->find($request->carModel)) {
                    if (!CarYear::where("CarModel_id", $request->carModel)->find($request->carYear)) {
                        return $this->errorMessage('Model Year of manufacture not found');
                    }
                } else {
                    return $this->errorMessage('Car Model not found');
                }
            } else {
                return $this->errorMessage('Car Maker not found');
            }

            if (!CarManufacture::find($request->carManufacturing)) {
                return $this->errorMessage('Manufacturing not found');
            }
            if (!CarCapacity::find($request->carCapacity)) {
                return $this->errorMessage('Capacity not found');
            }
            if (!CarBody::find($request->bodyStyle)->where("active", 1)) {
                return $this->errorMessage('Car Body not found');
            }
            if (!CarColor::find($request->color)) {
                return $this->errorMessage('Car Color not found');
            }
            if (Country::where("active", 1)->find($request->country)) {
                if (Governorate::where("active", 1)->where("country_id", $request->country)->find($request->governorate)) {
                    if (!City::where("active", 1)->where("governorate_id", $request->governorate)->where("country_id", $request->country)->find($request->city)) {
                        return $this->errorMessage('City not found');
                    }
                } else {
                    return $this->errorMessage('Governorate not found');
                }
            } else {
                return $this->errorMessage('Country not found');
            }
            if ((Badges::where("active", 1)->find($request->badgeList))->count() != count($request->badgeList)) {
                return $this->errorMessage('Badges not found');
            }
            if ((Feature::where("active", 1)->find($request->featureList))->count() != count($request->featureList)) {
                return $this->errorMessage('Features not found');
            }

            $credentials = $this->credentials($request);
            $car = Car::create($credentials);
            $alert = Alert::where("car_id", $car->id)->where("user_id", Auth()->id())->update([
                "status" => $request->status
            ]);
            if (!$alert) {
                Alert::create([
                    "car_id" => $car->id,
                    "user_id" => Auth()->id(),
                    "status" => ($request->isAlertBefore) ? Car::Alert : Car::NotAlert
                ]);
            }

            foreach ($credentials['CarPhotos'] as $key => $img) {
                car_img::create([
                    'car_id' => $car->id,
                    'img_id' => $img
                ]);
            }
            foreach ($request->badgeList as $key => $badge) {
                car_badge::create([
                    'car_id' => $car->id,
                    'badge_id' => $badge
                ]);
            }
            foreach ($request->featureList as $key => $feature) {
                car_feature::create([
                    'car_id' => $car->id,
                    'feature_id' => $feature
                ]);
            }
            ListCarUser::create([
                "user_id" => Auth::user()->id,
                "car_id" => $car->id
            ]);
            $type   = new DataType();
            $data = (new CarResource($car))->type($type::single);
            return  $this->returnData('mCar', $data, __('Successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function edit(Request $request)
    {

        $validator = $this->Validator($request, $this->rules(true));
        if (!$validator->fails()) {
            if (!$car = Car::find($request->car_id)) {
                return $this->errorMessage('Car ID not found');
            }
            if ($request->has("imageList")) {
                $check = $this->checkMultipleImage($request->imageList);
                if (!$check) {
                    return $this->errorMessage('wrong images');
                }
            }

            if (CarMaker::where("active", 1)->find($request->carMaker)) {
                if (CarModel::where("active", 1)->where("CarMaker_id", $request->carMaker)->find($request->carModel)) {
                    if (!CarYear::where("CarModel_id", $request->carModel)->find($request->carYear)) {
                        return $this->errorMessage('Model Year of manufacture not found');
                    }
                } else {
                    return $this->errorMessage('Car Model not found');
                }
            } else {
                return $this->errorMessage('Car Maker not found');
            }


            if (!CarManufacture::find($request->carManufacturing)) {
                return $this->errorMessage('Manufacturing not found');
            }
            if (!CarCapacity::find($request->carCapacity)) {
                return $this->errorMessage('Capacity not found');
            }
            if (!CarBody::where("active", 1)->find($request->bodyStyle)) {
                return $this->errorMessage('Car Body not found');
            }
            if (!CarColor::find($request->color)) {
                return $this->errorMessage('Car Color not found');
            }
            if (Country::where("active", 1)->find($request->country)) {
                if (Governorate::where("active", 1)->where("country_id", $request->country)->find($request->governorate)) {
                    if (!City::where("active", 1)->where("governorate_id", $request->governorate)->where("country_id", $request->country)->find($request->city)) {
                        return $this->errorMessage('City not found');
                    }
                } else {
                    return $this->errorMessage('Governorate not found');
                }
            } else {
                return $this->errorMessage('Country not found');
            }
            if ((Badges::where("active", 1)->find($request->badgeList))->count() != count($request->badgeList)) {
                return $this->errorMessage('Badges not found');
            }
            if ((Feature::where("active", 1)->find($request->featureList))->count() != count($request->featureList)) {
                return $this->errorMessage('Features not found');
            }

            if ($request->has("imageList")) {
                $CarPhotos = car_img::where('car_id', '=', $car->id)->get();
                $credentials = $this->credentials($request, $CarPhotos);
                if ($credentials['CarPhotos']) {
                    foreach ($credentials['CarPhotos'] as $key => $img) {
                        car_img::create([
                            'car_id' => $car->id,
                            'img_id' => $img
                        ]);
                    }
                }
            } else {
                $credentials = $this->credentials($request);
            }
            $car->update($credentials);
            $alert = Alert::where("car_id", $car->id)->where("user_id", Auth()->id())->update([
                "status" => ($request->isAlertBefore == "true") ? Car::Alert : Car::NotAlert
            ]);
            if (!$alert) {
                Alert::create([
                    "car_id" => $car->id,
                    "user_id" => Auth()->id(),
                    "status" => ($request->isAlertBefore == "true") ? Car::Alert : Car::NotAlert
                ]);
            }
            $CarBadges = car_badge::where('car_id', '=', $car->id)->get();
            foreach ($CarBadges as $key => $badge) {
                $badge->delete();
            }
            foreach ($request->badgeList as $key => $badge) {
                car_badge::create([
                    'car_id' => $car->id,
                    'badge_id' => $badge
                ]);
            }
            $CarFeatures = car_feature::where('car_id', '=', $car->id)->get();
            foreach ($CarFeatures as $key => $feature) {
                $feature->delete();
            }
            foreach ($request->featureList as $key => $feature) {
                car_feature::create([
                    'car_id' => $car->id,
                    'feature_id' => $feature
                ]);
            }

            $list_car_user = ListCarUser::where("car_id", $car->id)->where("user_id", Auth()->id())->update([
                "user_id" => Auth::user()->id,
                "car_id" => $car->id
            ]);
            if (!$list_car_user) {
                ListCarUser::create([
                    "user_id" => Auth::user()->id,
                    "car_id" => $car->id
                ]);
            }
            $type   = new DataType();
            $data = (new CarResource($car))->type($type::single);
            return  $this->returnData('mCar', $data, __('Edit successfully'));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
    public function list(Request $request)
    {
        $this->lang($request->lang);
        $type   = new DataType();
        $data = (new CarCollection(Car::where("user_id", Auth()->id())->get()))->type($type::list);
        if (!$data->count())
            return $this->errorMessage("No data found");
        return $data;
    }
    public static function rules($update = null)
    {
        $rules = [
            'carMaker'                 => 'required|integer',
            'carModel'                 => 'required|integer',
            'carYear'                  => 'required|integer',
            'carManufacturing'         => 'required|integer',
            'carCapacity'              => 'required|integer',
            'price'                    => 'required|integer',
            'discount'                 => 'nullable|integer|between:1,100',
            'isAccident'               => 'required|between:0,1',
            'isAlertBefore'            => 'required|between:0,1',
            'used_kilometers'          => 'required|integer',
            'bodyStyle'                => 'required|integer',
            'color'                    => 'required|integer',
            'description'              => 'required|string|min:3|max:1000',
            'description_ar'           => 'required|string|min:3|max:1000',
            'country'                  => 'required|integer',
            'governorate'              => 'required|integer',
            'city'                     => 'required|integer',
            'mLocation_latitude'       => 'required|numeric',
            'mLocation_longitude'      => 'required|numeric',
            'badgeList'                => 'required|array|min:1',
            'badgeList.*'              => 'required|integer',
            'featureList'              => 'required|array|min:1',
            'featureList.*'            => 'required|integer',
            'serviceHistory'           => 'required|string|min:3|max:1000',
            'transmission'             => 'required|integer|between:0,1',
            'carState'                 => 'required|integer|between:0,1',
            'payment_method'           => 'required|integer|between:0,2',
            'adsExpire'                => 'required|date',
            "carFuelType"              => 'required|integer|between:0,1',
            'mContact_phone'           => 'required|string',
            'mContact_whats'           => 'required|string',
            'payment_deposit'          => 'required|integer',
            'payment_loan_amount'      => 'required|integer',
            'payment_loan_period'      => 'required|integer',
            'imageList'                => 'required|array|min:1|max:5',

        ];
        if ($update) {
            $rules['imageList'] = 'nullable|array|min:1|max:5';
            $rules['car_id'] = 'required|integer';
        }
        return $rules;
    }

    public function credentials($request, $update = null)
    {
        $seller = Car::SELLER_INDIVIDUAL;
        if (Auth()->user()->Agency) {
            $seller = (Auth()->user()->Agency->center_type == 0) ? Car::SELLER_AGENCY : Car::SELLER_DISTRIBUTOR;
        }
        $credentials = [
            'CarMaker_id'                 => $request->carMaker,
            'CarModel_id'                 => $request->carModel,
            'CarYear_id'                  => $request->carYear,
            'CarManufacture_id'           => $request->carManufacturing,
            'CarCapacity_id'              => $request->carCapacity,
            'price'                       => $request->price,
            'AccidentBefore'              => ($request->isAccident) ? Car::AccidentBefore : Car::NotAccidentBefore,
            'kiloUsed'                    => $request->used_kilometers,
            'CarBody_id'                  => $request->bodyStyle,
            'CarColor_id'                 => $request->color,
            'Description'                 => $request->description,
            'Description_ar'              => $request->description_ar,
            'Country_id'                  => $request->country,
            'Governorate_id'              => $request->governorate,
            'City_id'                     => $request->city,
            'lat'                         => $request->mLocation_latitude,
            'lng'                         => $request->mLocation_longitude,
            'ServiceHistory'              => $request->serviceHistory,
            'transmission'                => $request->transmission,
            'isNew'                       => $request->carState,
            'payment'                     => $request->payment_method,
            'adsExpire'                   => date("Y-m-d", strtotime($request->adsExpire)),
            "FuelType"                    => $request->carFuelType,
            'phone'                       => $request->mContact_phone,
            'whats'                       => $request->mContact_whats,
            'DepositPrice'                => $request->payment_deposit,
            'InstallmentAmount'           => $request->payment_loan_amount,
            'InstallmentPeriod'           => $request->payment_loan_period,
            'SellerType'                  => $seller,
            'views'                       => 0,
            'status'                      => Car::STATUS_DISABLE,
            'user_id'                     => Auth()->user()->id,
        ];

        if ($request->has("imageList")) {
            if ($update) {
                foreach ($update as $key => $photo) {
                    $this->Updated_file($photo);
                }

                foreach ($request->imageList as $file) {
                    $Image_id = User::fileApi($file);
                    $credentials['CarPhotos'][] = $Image_id;
                }
            } else {
                foreach ($request->imageList as $file) {
                    $Image_id = User::fileApi($file);
                    $credentials['CarPhotos'][] = $Image_id;
                }
            }
        }

        if ($request->discount) {
            $credentials['price_after_discount'] = $request->discount;
        } else {
            $credentials['price_after_discount'] = 0;
        }
        return $credentials;
    }
    public function carBody()
    {
        $carBodyLists  = CarBody::where('active', 1)->get();
        $carBodies     = [];
        foreach ($carBodyLists as $carBodyList) {
            $carBodies[]   = [
                "id"        => $carBodyList->id,
                "logo"      => find_image(@$carBodyList->logo),
                "title_en"  => $carBodyList->name,
            ];
        }
        return $this->returnData("listMain", $carBodies, "Successfully");
    }
    public function carFeature()
    {
        $featureLists  = Feature::where('active', 1)->get();
        $features     = [];
        foreach ($featureLists as $featureList) {
            $features[]   = [
                "id"        => $featureList->id,
                "title_en"  => $featureList->name,
                "title_ar"  => $featureList->name_ar,
            ];
        }
        return $this->returnData("listMain", $features, "Successfully");
    }
    public function carBadge()
    {
        $BadgesLists  = Badges::where('active', 1)->get();
        $badges     = [];
        foreach ($BadgesLists as $BadgesList) {
            $badges[]   = [
                "id"        => $BadgesList->id,
                "title_en"  => $BadgesList->name,
                "title_ar"  => $BadgesList->name_ar,
            ];
        }
        return $this->returnData("listMain", $badges, "Successfully");
    }
    public function carColors(Request $request)
    {
        if ($request->car_id) {
            $carColor   = Car::find($request->car_id);
            if ($carColor) {
                $colorList  = [
                    "id"    => $carColor->color->id,
                    "code"  => $carColor->color->code
                ];
                return $colorList;
            } else {
                return $this->errorMessage(__("No such car id"));
            }
        } else {
            $carColors  = CarColor::all();
            $colors     = [];
            foreach ($carColors as $carColor) {
                $colors[]   = [
                    "id"        => $carColor->id,
                    "code"  => $carColor->code,
                ];
            }
            return $colors;
        }
    }
    public function checkMultipleImage($files)
    {

        foreach ($files as $file) {
            if (!$this->checkImage($file))
                return false;
        }
        return true;
    }
    public static function Updated_file($file)
    {
        $Image = Image::find($file->img_id);
        if ($Image) {
            $destinationPath = public_path() . '/' . $Image->base;
            try {
                $file_old = $destinationPath . $Image->name;
                unlink($file_old);
            } catch (Exception $e) {
            }
        }
        $Image->delete();
        return true;
    }
}
