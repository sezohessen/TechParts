<?php

namespace App\Http\Controllers\api;

use App\Models\Car;
use App\Models\Badges;
use App\Models\Feature;
use App\Models\car_badge;
use App\Models\car_feature;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\CarBody;
use App\Models\CarMaker;
use App\Models\CarManufacture;
use App\Models\CarModel;
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
        $car_badges=[];
        foreach($CarBadges as $item){
            if($badge=Badges::where('active', '=', 1)->find($item->badge_id)){
                $car_badges[]=attr_lang($badge);
            }

        }
        $car_features=[];
        foreach($CarFeatures as $item){
            if($feature=Feature::where('active', '=', 1)->find($item->feature_id)){
                $car_features[]=attr_lang($feature);
            }
        }
        $carMan=attr_lang(CarManufacture::find($car->CarManufacture_id));
        $data = [
            "aboutCar" =>Session::get('app_locale')=='ar'? $car->Description_ar : $car->Description ,
            "adsExpire" =>date("Y-m-d",strtotime("+1 month",strtotime($car->created_at))),
            "badgeList"=>$car_badges,
            //carFuelType
            "bodyStyle"=>CarBody::find($car->CarBody_id)->name,
            "carMaker"=>@CarMaker::where('active', '=', 1)->find($car->CarMaker_id)->name,
            "carManufacturing"=>$carMan,
            "carModel"=>@CarModel::where('active', '=', 1)->find($car->CarModel_id)->name,
            "carState"=>@CarModel::where('active', '=', 1)->find($car->CarModel_id)->name,


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
}
