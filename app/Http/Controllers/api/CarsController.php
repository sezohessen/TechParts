<?php

namespace App\Http\Controllers\api;

use App\Models\Car;

use App\Models\car_img;
use App\Models\Country;
use App\Models\car_badge;
use App\Models\PromoteCar;
use App\Models\car_deposit;
use App\Models\car_feature;
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
            $car->update(["status"=>$request->status]);
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
        return 1;
    }

    public static function rules($request,$id = NULL)
    {
        $rules = [
            'carMaker'                 => 'required|integer',
            'carModel'                 => 'required|integer',
            'carYear'                  => 'required|integer',
            'carManufacturing'           => 'required|integer',
            'carCapacity'              => 'required|integer',
            'price'                       => 'required|integer',
            'discount'        => 'nullable|integer|between:1,100',
            'isAccident'              => 'required|integer',
            'used_kilometers'                    => 'required|integer',
            'bodyStyle'                  => 'required|integer',
            'color'                 => 'required|integer',
            'badgeList'                    => 'required|array|min:1',
            'featureList'                  => 'required|array|min:1',
            'description'                 => 'required|string|min:3|max:1000',
            'description_ar'              => 'required|string|min:3|max:1000',
            'country'                  => 'required|integer',
            'governorate'              => 'required|integer',
            'city'                     => 'required|integer',
            'mLocation_latitude'                         => 'required|numeric',
            'mLocation_longitude'                         => 'required|numeric',
            'serviceHistory'              => 'required|string|min:3|max:1000',
            'transmission'                => 'required|integer',
            'carState'                       => 'required|integer',
            'SellerType'                  => 'required|integer',
            'payment_method'                     => 'required|integer',
            'mContact_phone'                       => 'required|string',
            'payment_deposit'                => 'required|string',
            'payment_loan_amount'            => 'required|integer',
            'payment_loan_period'            =>  ['required', new periodValidate],
            'CarPhotos'                   => 'required|max:5',
            'CarPhotos.*'                 => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            "whats"                       => 'required|string',
        ];
        if($id){
            $rules['CarPhotos'] = 'nullable';
            $rules['CarPhotos.*'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
}
