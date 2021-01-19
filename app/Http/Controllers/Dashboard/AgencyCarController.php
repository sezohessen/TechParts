<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\AgencyCarMaker;
use App\Models\Car;
use App\Models\City;
use App\Models\Badges;
use App\Models\car_img;
use App\Models\CarBody;
use App\Models\CarYear;
use App\Models\Country;
use App\Models\Feature;
use App\Models\CarColor;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use App\Models\Governorate;
use App\Models\ListCarUser;
use App\Models\car_badge;
use App\Models\car_feature;
use App\Models\CarManufacture;
use Illuminate\Http\Request;

class AgencyCarController extends Controller
{
    //


    public function create()
    {
        $page_title         = __("Add agency car");
        $page_description   = __("Add new Car");
        $makers             = CarMaker::where('active', '=', 1)->get();
        $bodies             = CarBody::all();
        $years              = CarYear::all();
        $badges             = Badges::where('active', '=', 1)->get();
        $features           = Feature::where('active', '=', 1)->get();
        $countries          = Country::all();
        $manufactures       = CarManufacture::all();
        $capacities         = CarCapacity::all();
        $colors             = CarColor::all();
        $agencies           = Agency::all();
        //dd($page_title,$page_description,$makers,$bodies,$years,$badges,$features,$countries,$manufactures,$capacities,$colors);
        return view('dashboard.Agency.Car.add', compact('page_title', 'page_description','makers','agencies',
        "years","bodies","badges","features","countries","manufactures","capacities","colors"));
    }
    public function show($id)
    {
        $Agency = Agency::findOrFail( $id);

        if($Agency->carMakers->count() > 0 ){
            return response()->json([
                'carMakers' => $Agency->carMakers
            ]);
        }
        return response()->json([
            'carMakers' => null
        ]);
    }
}
