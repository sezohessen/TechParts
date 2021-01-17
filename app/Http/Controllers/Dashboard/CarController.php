<?php

namespace App\Http\Controllers\Dashboard;
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
use Illuminate\Http\Request;
use App\Models\CarManufacture;
use App\Http\Controllers\Controller;
use App\Models\car_badge;
use App\Models\car_feature;
use Illuminate\Support\Facades\Auth;
use App\DataTables\CarDatatable;
use App\Models\Image;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarDatatable $car)
    {
        $page_title = __('Cars Options ');
        $page_description = __('View Cars');
        return  $car->render("dashboard.Car.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Car");
        $page_description = __("Add new Car");
        $makers=CarMaker::where('active', '=', 1)->get();
        $bodies=CarBody::all();
        $years=CarYear::all();
        $badges=Badges::where('active', '=', 1)->get();
        $features=Feature::where('active', '=', 1)->get();
        $countries=Country::all();
        $manufactures=CarManufacture::all();
        $capacities=CarCapacity::all();
        $colors=CarColor::all();
        return view('dashboard.Car.add', compact('page_title', 'page_description','makers',
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
        session()->flash('created',__("Changed has been Created successfully!"));
        return redirect()->route("dashboard.car.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $page_title = __("Edit Car");
        $page_description = __("Edit Car");
        $makers=CarMaker::where('active', '=', 1)->get();
        $bodies=CarBody::all();
        $years=CarYear::all();
        $badges=Badges::where('active', '=', 1)->get();
        $features=Feature::where('active', '=', 1)->get();
        $countries=Country::all();
        $manufactures=CarManufacture::all();
        $capacities=CarCapacity::all();
        $colors=CarColor::all();
        $CarPhotos=car_img::where('car_id', '=', $car->id)->get();
        $CarBadges=car_badge::where('car_id', '=', $car->id)->get();
        $CarFeatures=car_feature::where('car_id', '=', $car->id)->get();
        $images=[];
        foreach($CarPhotos as $item){
            $images[]=Image::find($item->img_id);
        }
        $car_badges=[];
        foreach($CarBadges as $item){
            $car_badges[]=Badges::find($item->badge_id);
        }
        $car_features=[];
        foreach($CarFeatures as $item){
            $car_features[]=Feature::find($item->feature_id);
        }
        return view('dashboard.Car.edit', compact('page_title', 'page_description','car','makers',
        "years","bodies","badges","features","countries","manufactures","capacities","colors","images"));
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
    public function destroy(Car $car)
    {
        $images=car_img::where("car_id",$car->id)->get();
        Car::unlink_img($images);
        $car->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.car.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
                $car = Car::find($id);
                $images=car_img::where("car_id",$car->id)->get();
                Car::unlink_img($images);
				$car->delete();
			}
		} else {
            $car = Car::find(request('item'));
            $images=car_img::where("car_id",$car->id)->get();
            Car::unlink_img($images);
			$car->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.car.index");
    }
    public function available_model($id){
        $models = CarModel::where('CarMaker_id', $id)->where('active', 1)->get();
        if($models->count() > 0 ){
            return response()->json([
                'models' => $models
            ]);
        }
        return response()->json([
            'models' => null
        ]);
    }
    public function available_governorate($id){
        $governorates = Governorate::where('country_id', $id)->get();
        if($governorates->count() > 0 ){
            return response()->json([
                'governorates' => $governorates
            ]);
        }
        return response()->json([
            'governorates' => null
        ]);
    }
    public function available_city($id){
        $cities = City::where('governorate_id', $id)->get();
        if($cities->count() > 0 ){
            return response()->json([
                'cities' => $cities
            ]);
        }
        return response()->json([
            'cities' => null
        ]);
    }

}
