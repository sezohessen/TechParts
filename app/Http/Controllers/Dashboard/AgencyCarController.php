<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\AgencyCar;
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
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Car::rules($request);
        $request->validate($rules);
        //Validate AgencyCar
        $rules      = AgencyCar::rules($request);
        $request->validate($rules);
        $credentials = Car::credentials($request);
        $car = Car::create($credentials);
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
        //AgencyCar::create
        $credentials    = AgencyCar::credentials($request,$car->id);
        $agency_cars    = AgencyCar::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.car.index");
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
    public function edit($id)
    {
        $car                = Car::find($id);
        if($car==NULL){
            return redirect()->route('dashboard.AgencyCar.index');
        }
        $page_title         = __("Edit agency car");
        $page_description   = __("Edit Car");
        $makers             = CarMaker::where('active', 1)->get();
        $bodies             = CarBody::all();
        $years              = CarYear::all();
        $badges             = Badges::where('active', 1)->get();
        $features           = Feature::where('active', 1)->get();
        $countries          = Country::all();
        $manufactures       = CarManufacture::all();
        $capacities         = CarCapacity::all();
        $colors             = CarColor::all();
        $agencies           = Agency::all();
        $agencyCar          = AgencyCar::where('car_id',$id)->first();
        $CarPhotos          = car_img::where('car_id', $id)->get();
        $CarBadges          = car_badge::where('car_id',$id)->get();
        $CarFeatures        = car_feature::where('car_id',$id)->get();
        $images             = [];
        foreach($CarPhotos as $item){
            $images[]       = Image::find($item->img_id);
        }
        $car_badges = [];
        foreach($CarBadges as $item){
            $car_badges[]   = Badges::find($item->badge_id);
        }
        $car_features=[];
        foreach($CarFeatures as $item){
            $car_features[] = Feature::find($item->feature_id);
        }
        return view('dashboard.Agency.Car.edit', compact('page_title', 'page_description','car','makers','agencies',
        "years","bodies","badges","features","countries","manufactures","capacities","colors","images",'agencyCar'));
    }
}
