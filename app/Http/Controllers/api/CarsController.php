<?php

namespace App\Http\Controllers\api;

use App\Models\Car;

use App\Models\Alert;
use App\Models\car_img;
use App\Models\Country;
use App\Models\car_badge;
use App\Models\PromoteCar;
use App\Models\car_deposit;
use App\Models\car_feature;
use App\Models\ListCarUser;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Classes\Responseobject;

use function PHPSTORM_META\type;
use App\Models\subscribe_package;
use App\Http\Resources\CarResource;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CarCollection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\SubscribeResource;
use Illuminate\Support\Facades\Validator as Validator;

class DataType {
    const single = 1;
    const list = 2;
    const compare = 3;
    const promote = 4;

}
class CarsController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lang($lang)
    {
        if ($locale = $lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        return true;
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
        $this->lang( $request->lang);
        return Validator::make($request->all(),$rules,[],$niceNames);
    }
    public function details(Request $request)
    {
        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car not found');
            }
            $type   = new DataType();
            $data=(new CarResource($car))->type($type::single);
            return $data;
            return  $this->returnData('mCar',$data,__('Successfully'));
        }else {
            return $this->failed($validator);
        }

    }


    public function search(Request $request)
    {

        $validator=$this->Validator($request,[
            "interest_country" => 'required|integer',
            "car_status"       => 'required|string|max:255|in:Used,New,مستعملة,جديدة',
            "word"             => 'required|string|max:255',
        ]);
        if (!$validator->fails()) {
            if(session()->get('app_locale')=="ar")
                $status=(($request->car_status=="جديدة") ? Car::IS_NEW : Car::IS_USED);
            else {
                $status=(($request->car_status=="New") ? Car::IS_NEW : Car::IS_USED);
            }
            if(!$country=Country::find($request->interest_country)){
                return $this->errorMessage('Country not found');
            }
            $type   = new DataType();
            $data=(new CarCollection(
                Car::where("Country_id",$country->id)
                ->orWhereHas('maker', function($query)use($request){
                    $query->where('name','LIKE',$request->word);
                })
                ->orWhere('IsNew', '=', $status)
                ->paginate(10)
            ))->type($type::list);
            return $data;
        }else {
            return $this->failed($validator);
        }
    }
    public function deposit(Request $request)
    {

        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
            "price"             => 'required|integer',
            "weaccept_order_id" => 'required',
        ],[
            'weaccept_order_id' => __('Order ID'),
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car not found');
            }
            car_deposit::create([
                'user_id'=> Auth()->user()->id,
                'car_id'=> $car->id,
                'price'=> $request->price,
                'weaccept_order_id'=> $request->weaccept_order_id
            ]);
            $type   = new DataType();
            $data=(new CarResource($car))->type($type::list);
            return  $this->returnData('mCar',$data,__('Deposit Successfully'));

        }else {
            return $this->failed($validator);
        }
    }
    public function alert(Request $request)
    {
        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
            "status"             => 'required|integer|between:0,1',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car not found');
            }
            $alert=Alert::where("car_id",$request->car_id)->where("user_id",Auth()->id())->update([
                "status"=>$request->status
            ]);
            if(!$alert){
                Alert::create([
                    "car_id"=>$request->car_id,
                    "user_id"=>Auth()->id(),
                    "status"=>$request->status
                ]);
            }
            return  $this->returnSuccess(__('Success change Status of car'));

        }else {
            return $this->failed($validator);
        }
    }
    public function compare(Request $request)
    {
        $validator=$this->Validator($request,[
            "car_id_01"            => 'required|integer',
            "car_id_02"             => 'required|integer|different:car_id_01',
        ],[
            'car_id_01' => __('First Car ID'),
            'car_id_02' => __('Second Car ID'),
        ]);
        if (!$validator->fails()) {
            if(!$first_car=Car::find($request->car_id_01)){
                return $this->errorMessage('First Car ID not found');
            }
            if(!$second_car=Car::find($request->car_id_02)){
                return $this->errorMessage('Second Car ID not found');
            }
            $type   = new DataType();
            $data=(new CarCollection(Car::find([$request->car_id_01,$request->car_id_02])))
            ->type($type::compare);
            return  $data;

        }else {
            return $this->failed($validator);
        }
    }
    public function action_counter(Request $request){
        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('First Car ID not found');
            }
        $car->update(["views"=>$car->views+1]);
        return  $this->returnSuccess(__('Car views has been increment successfully'));

        }else {
            return $this->failed($validator);
        }
    }
    public function promote_package(Request $request){
        $this->lang($request->lang);
        $package= SubscribeResource::collection(subscribe_package::all());
        return  $this->returnData('packageList',$package,__('Successfully get Subscribed Packages'));
    }
    public function promote(Request $request){

        $validator=$this->Validator($request,[
            "car_id"               => 'required|integer',
            "subscribe_package_id" => 'required|integer',
            "price"                => 'required|integer',
            "weaccept_order_id"    => 'required',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('First Car ID not found');
            }elseif(!$subscribe_package=subscribe_package::find($request->subscribe_package_id)){
                return $this->errorMessage('Subscribe Package  ID not found');
            }
            if(!strtotime($subscribe_package->period)){
                return $this->errorMessage('Subscribe Package invalid period');
            }
            if($car->promotedStatus){
                $car->update([
                    "promotedExpire"=> date("Y-m-d",strtotime("+".$subscribe_package->period,strtotime($car->promotedExpire))),
                    'promotedStatus'=>true
                ]);
            }else {
                $car->update([
                    "promotedExpire"=> date("Y-m-d",strtotime("+".$subscribe_package->period,strtotime($car->adsExpire))),
                    'promotedStatus'=>true
                ]);
            }
            PromoteCar::create([
                "car_id"=>$car->id,
                "subscribe_package_id"=>$subscribe_package->id,
                "user_id"=>Auth()->user()->id,
                "price"=>$request->price,
                "weaccept_order_id"=>$request->weaccept_order_id
            ]);
            $type   = new DataType();
            $data=(new CarResource($car))->type($type::promote);
            return  $this->returnData('mCar',$data,__('Promoted Successfully'));

        }else {
            return $this->failed($validator);
        }
    }
    public function copy(Request $request){
        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car ID not found');
            }
            unset($car['adsExpire']);
            $car['views']=0;
            $new_car = $car->replicate();
            $new_car->save();
            $CarPhotos=car_img::where('car_id', '=', $car->id)->get();
            foreach($CarPhotos as $key=>$img){
                car_img::create([
                    'car_id'=>$new_car->id,
                    'img_id'=>$img->img_id
                ]);
            }
            $CarBadges=car_badge::where('car_id', '=', $car->id)->get();
            foreach($CarBadges as $key=>$badge){
                car_badge::create([
                    'car_id'=>$new_car->id,
                    'badge_id'=>$badge->badge_id
                ]);
            }
            $CarFeatures=car_feature::where('car_id', '=', $car->id)->get();
            foreach($CarFeatures as $key=>$feature){
                car_feature::create([
                    'car_id'=>$new_car->id,
                    'feature_id'=>$feature->feature_id
                ]);
            }
            ListCarUser::create([
                "user_id"=>$new_car->user->id,
                "car_id"=>$new_car->id
            ]);
            $car=Car::find($new_car->id);
            $type   = new DataType();
            $data=(new CarResource($car))->type($type::single);
            return  $this->returnData('mCar',$data,__('Successfully'));

        }else {
            return $this->failed($validator);
        }
    }
    public function delete(Request $request){
        $validator=$this->Validator($request,[
            "car_id"            => 'required|integer',
        ]);
        if (!$validator->fails()) {
            if(!$car=Car::find($request->car_id)){
                return $this->errorMessage('Car ID not found');
            }
            $images=car_img::where("car_id",$car->id)->get();
            Car::unlink_img($images);
            $CarBadges=car_badge::where('car_id', '=', $car->id)->get();
            foreach($CarBadges as $key=>$badge){
                $badge->delete();
            }
            $CarFeatures=car_feature::where('car_id', '=', $car->id)->get();
            foreach($CarFeatures as $key=>$feature){
                $feature->delete();
            }
            $car->delete();
            return  $this->returnSuccess(__('Deleted successfully'));

        }else {
            return $this->failed($validator);
        }
    }
    public function create(Request $request){
        $rules =$this->rules($request);
        $request->validate($rules);
        $credentials = $this->credentials($request);
        $car = Car::create($credentials);
        $alert=Alert::where("car_id",$request->car_id)->where("user_id",Auth()->id())->update([
            "status"=>$request->status
        ]);
        if(!$alert){
            Alert::create([
                "car_id"=>$request->car_id,
                "user_id"=>Auth()->id(),
                "status"=> $request->isAlertBefore ? Car::Alert: Car::NotAlert
            ]);
        }

        foreach($credentials['CarPhotos'] as $key=>$img){
            car_img::create([
                'car_id'=>$car->id,
                'img_id'=>$img
            ]);
        }
        foreach($request->badge_id as $key=>$badge){
            car_badge::create([
                'car_id'=>$car->id,
                'badge_id'=>$badge
            ]);
        }
        foreach($request->feature_id as $key=>$feature){
            car_feature::create([
                'car_id'=>$car->id,
                'feature_id'=>$feature
            ]);
        }
        ListCarUser::create([
            "user_id"=>Auth::user()->id,
            "car_id"=>$car->id
        ]);
    }

    public static function rules($request,$id = NULL)
    {
        $rules = [
            'carMaker'                 => 'required|integer',
            'carModel'                 => 'required|integer',
            'carYear'                  => 'required|integer',
            'carManufacturing'         => 'required|integer',
            'carCapacity'              => 'required|integer',
            'price'                    => 'required|integer',
            'discount'                 => 'nullable|integer|between:1,100',
            'isAccident'               => 'required|boolean',
            'isAlertBefore'            => 'required|boolean',
            'used_kilometers'          => 'required|integer',
            'bodyStyle'                => 'required|integer',
            'color'                    => 'required|integer',
            'badgeList'                => 'required|array|min:1',
            'featureList'              => 'required|array|min:1',
            'description'              => 'required|string|min:3|max:1000',
            'description_ar'           => 'required|string|min:3|max:1000',
            'country'                  => 'required|integer',
            'governorate'              => 'required|integer',
            'city'                     => 'required|integer',
            'mLocation_latitude'       => 'required|numeric',
            'mLocation_longitude'      => 'required|numeric',
            'serviceHistory'           => 'required|string|min:3|max:1000',
            'transmission'             => 'required|in:Automatic,Manual,أوتوماتيكي,يدوي',
            'carState'                 => 'required|in:Used,New,مستعملة,جديدة',
            'payment_method'           => 'required|in:Cash,Installment,Financing,نقدي,تقسيط,مالي',
            'adsExpire'                => 'required|date',
            "carFuelType"              => 'required|in:Petrol,Gas,بيترول,غاز',
            'mContact_phone'           => 'required|string',
            'mContact_whats'           => 'required|string',
            'payment_deposit'          => 'required|integer',
            'payment_loan_amount'      => 'required|string',
            'payment_loan_period'      => 'required|string',
            'imageList'                => 'required|max:5',
            'imageList.*'              => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ];
        return $rules;
    }
    public function credentials($request){
        $credentials =[
        'CarMaker_id'                 => $request->carMaker,
        'CarModel_id'                 => $request->carModel,
        'CarYear_id'                  => $request->carYear,
        'CarManufacture_id'           => $request->carManufacturing,
        'CarCapacity_id'              => $request->carCapacity,
        'price'                       => $request->price,
        'price_after_discount'        => $request->discount,
        'AccidentBefore'              => $request->isAccident ? Car::AccidentBefore: Car::NotAccidentBefore,
        'kiloUsed'                    => $request->used_kilometers,
        'CarBody_id'                  => $request->bodyStyle,
        'CarColor_id'                 => $request->color,
        'badge_id'                    => $request->badgeList,
        'feature_id'                  => $request->featureList,
        'Description'                 => $request->description,
        'Description_ar'              => $request->description_ar,
        'Country_id'                  => $request->country,
        'Governorate_id'              => $request->governorate,
        'City_id'                     => $request->city,
        'lat'                         => $request->mLocation_latitude,
        'lng'                         => $request->mLocation_longitude,
        'serviceHistory'              => $request->serviceHistory,
        'transmission'                => ($request->transmission == __("Manual")) ? Car::TRANSIMSSION_MANUAL: Car::TRANSIMSSION_AUTOMATIC,
        'isNew'                       => ($request->carState == __("Used")) ? Car::IS_USED: Car::IS_NEW,
        'payment'                     => $this->PaymentType($request->payment_method),
        'adsExpire'                   => $request->adsExpire,
        "FuelType"                    => ($request->carFuelType == __("Petrol")) ? Car::FUEL_PETROL: Car::FUEL_GAS,
        'phone'                       => $request->mContact_phone,
        'whats'                       => $request->mContact_whats,
        'DepositPrice'                => $request->payment_deposit,
        'InstallmentAmount'           => $request->payment_loan_amount,
        'InstallmentPeriod'           => $request->payment_loan_period,
        'SellerType'                  => Auth()->user()->Agency ? Car::SELLER_AGENCY: Car::SELLER_INDIVIDUAL,
        'views'                       => 0,
        'status'                      => Car::STATUS_ACTIVE,
        'user_id'                     => Auth()->user()->id,
        'CarPhotos'                   => $request->carMaker,
        'CarPhotos.*'                 => $request->carMaker
        ];
        return $credentials;
    }
    public static function PaymentType()
    {
        return [
            __('Cash')         => Car::PAYMENT_CASH,
            __('Installment')  => Car::PAYMENT_INSTALLMENT,
            __('Financing')    => Car::PAYMENT_FINANCING  ,
        ];
    }
}
