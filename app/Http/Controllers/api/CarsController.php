<?php

namespace App\Http\Controllers\api;

use App\Models\Car;
use App\Models\Image;
use App\Models\Badges;
use App\Models\car_img;
use App\Models\CarBody;
use App\Models\CarYear;
use App\Models\Feature;
use App\Models\CarColor;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\car_badge;
use App\Models\car_feature;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\CarManufacture;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\ListCarUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CarsController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {
        return 1;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
        if (!$request->car_id) {
            return $this->errorField("Car ID ");
        }
        if(!$car=Car::find($request->car_id)){
            return $this->errorMessage('Car not found');
        }
        $CarBadges=car_badge::where('car_id', '=', $car->id)->get();
        $CarFeatures=car_feature::where('car_id', '=', $car->id)->get();
        $CarPhotos=car_img::where('car_id', '=', $car->id)->get();
        $car_badges=[];
        foreach($CarBadges as $item){
            if($badge=Badges::where('active', '=', 1)->find($item->badge_id)){
                $car_badges[]=attr_lang_name($badge);
            }

        }
        $car_features=[];
        foreach($CarFeatures as $item){
            if($feature=Feature::where('active', '=', 1)->find($item->feature_id)){
                $car_features[]=attr_lang_name($feature);
            }
        }
        $images=[];
        foreach($CarPhotos as $item){
            $images[]=url('img/Cars/'.Image::find($item->img_id)->name);
        }
        $carMan=attr_lang_name(CarManufacture::find($car->CarManufacture_id));
         //  return ListCarUser::where('car_id','=',$car->id)->get();
        if($car->payment== Car::PAYMENT_CASH ){
            $payment=__("Cash");
        }else {
            $payment=$car->payment== Car::PAYMENT_INSTALLMENT ? __("Installment") :  __("Financing");
        }
        $price= $car->price-($car->price_after_discount*0.01*($car->price));
        $payment_loan_amount=$car->InstallmentPrice." ".Country::find($car->Country_id)->code." / ".$car->InstallmentMonth." months";
        $data = [
            "aboutCar" =>attr_lang_desc($car),
            "adsExpire" =>date("Y-m-d",strtotime("+1 month",strtotime($car->created_at))),
            "badgeList"=>$car_badges,
            //carFuelType
            "bodyStyle"=>CarBody::find($car->CarBody_id)->name,
            "carMaker"=>@CarMaker::where('active', '=', 1)->find($car->CarMaker_id)->name,
            "carManufacturing"=>$carMan,
            "carModel"=>@CarModel::where('active', '=', 1)->find($car->CarModel_id)->name,
            "carState"=>$car->status== Car::STATUS_NEW ? __("New") :  __("Used"),
            "carYear"=>@CarYear::find($car->CarYear_id)->year,
            "color"=>@CarColor::find($car->CarColor_id)->code,
            "featureList"=>$car_features,
            "id"=>$car->id,
            "imageList"=>$images,
            "isAccident"=>($car->AccidentBefore) ? true :false,
            "isAlertBefore"=>null,
            "isFavorite"=>null,
            "mContact"=> [
                "phone"=>$car->phone,
                "whats"=>null
            ],
            "mDistributor"=>[
                "image"=> null,
                "name"=> null,
                "rate"=> null,
                "userId"=> null,
                "userType"=> null
            ],
            "mLocation"=>[
                "city_name"=>attr_lang_title(City::find($car->City_id)),
                "government_name"=>attr_lang_title(Governorate::find($car->Governorate_id)),
                "latitude"=>$car->lng,
                "longitude"=>$car->lat,
            ],
            "other_costs"=>null,
            "payment_deposit"=>$car->DepositPrice,
            "payment_loan_amount"=>$payment_loan_amount ,
            "payment_loan_period"=>null,
            "payment_method"=>$payment,
            "price"=> (int)$price,
            "price_before_discount"=> $car->price,
            "promotedStatus"=> null,
            "serviceHistory"=>$car->ServiceHistory,
            "transmission"=> $car->transmission== Car::TRANSIMSSION_MANUAL ? __("Manual") :  __("Automatic"),
            "used_kilometers"=> $car->kiloUsed
            //CarCapacity_id
            //SellerType
        ];
        return  $this->returnData('mCar',$data,__('Successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function search(Request $request)
    {

        $data=[
            'carList'=>[

            ],
            'links'=>[
                "prev"=> null,
                "next"=> null,
            ],
            "meta"=> [
                "currentPage"=> 1,
                "from"=> 1,
                "lastPage"=> 1,
                "path"=> "http://example.com/api/v1/advanced-serach",
                "perPage"=> 10,
                "to"=> 3,
                "total"=> 3
            ]
        ];
        return  $this->returnMultipleData(array_keys($data),array_values($data),__('Successfully'));
    }
}
