<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Car;
use App\Models\City;
use App\Models\Image;
use App\Models\Agency;
use App\Models\Badges;
use App\Models\car_img;
use App\Models\CarBody;
use App\Models\CarYear;
use App\Models\Country;
use App\Models\Feature;
use App\Models\CarColor;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\AgencyCar;
use App\Models\car_badge;
use App\Models\car_feature;
use App\Models\CarCapacity;
use App\Models\Governorate;
use App\Models\ListCarUser;
use Illuminate\Http\Request;
use App\Models\AgencyCarMaker;
use App\Models\CarManufacture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\AgencyCarDatatable;

class AgencyCarController extends Controller
{
    //

    public function index(AgencyCarDatatable $car)
    {
        $page_title = __('Agency Cars Options');
        $page_description = __('View Cars');
        return  $car->render("dashboard.Agency.Car.index", compact('page_title', 'page_description'));
    }
    public function create()
    {


        $page_title         = __("Add agency car");
        $page_description   = __("Add new Car");
        $bodies             = CarBody::where('active', '=', 1)->get();
        $years              = CarYear::all();
        $badges             = Badges::where('active', '=', 1)->get();
        $features           = Feature::where('active', '=', 1)->get();
        $countries          = Country::where('active', '=', 1)->get();
        $manufactures       = CarManufacture::all();
        $capacities         = CarCapacity::all();
        $colors             = CarColor::all();
        $agencies           = Agency::where('active', '=', 1)->get();
        //dd($page_title,$page_description,$makers,$bodies,$years,$badges,$features,$countries,$manufactures,$capacities,$colors);
        return view('dashboard.Agency.Car.add', compact('page_title', 'page_description','agencies',
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
        return redirect()->route("dashboard.AgencyCar.index");
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
        $bodies=CarBody::all();
        $years=CarYear::all();
        $badges=Badges::where('active', '=', 1)->get();
        $features=Feature::where('active', '=', 1)->get();
        $countries=Country::where('active', '=', 1)->get();
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
            $car_badges[]=$item->badge_id;
        }
        $car_features=[];
        foreach($CarFeatures as $item){
            $car_features[]=$item->feature_id;
        }
        $agencies           = Agency::where('active', '=', 1)->get();
        $agencyCar          = AgencyCar::where('car_id',$id)->first();
        return view('dashboard.Agency.Car.edit', compact('page_title', 'car_badges','car_features','page_description','car','agencies',
        "years","bodies","badges","features","countries","manufactures","capacities","colors","images",'agencyCar'));
    }
    public function update(Request $request,Car $AgencyCar)
    {

        $rules = Car::rules($request,true);
        $request->validate($rules);
        $rules      = AgencyCar::rules($request);
        $request->validate($rules);
        if($request->file('CarPhotos')){
            $CarPhotos=car_img::where('car_id', '=', $AgencyCar->id)->get();
            $credentials =$AgencyCar->credentials($request,$CarPhotos);
            foreach($credentials['CarPhotos'] as $key=>$img){
                car_img::create([
                    'car_id'=>$AgencyCar->id,
                    'img_id'=>$img
                ]);
            }
        }else {
            $credentials =$AgencyCar->credentials($request);
        }

        $AgencyCar->update($credentials);
        $CarBadges=car_badge::where('car_id', '=', $AgencyCar->id)->get();
        foreach($CarBadges as $key=>$badge){
            $badge->delete();
        }
        foreach($request->badge_id as $key=>$badge){
            car_badge::create([
                'car_id'=>$AgencyCar->id,
                'badge_id'=>$badge
            ]);
        }
        $CarFeatures=car_feature::where('car_id', '=', $AgencyCar->id)->get();
        foreach($CarFeatures as $key=>$feature){
            $feature->delete();
        }
        foreach($request->feature_id as $key=>$feature){
            car_feature::create([
                'car_id'=>$AgencyCar->id,
                'feature_id'=>$feature
            ]);
        }
        $credentials    = AgencyCar::credentials($request,$AgencyCar->id);
        $AgencyCar->agencies()->sync([$request->agency_id]);
        session()->flash('created',__("Changes has been Updated Successfully"));
        return redirect()->route("dashboard.AgencyCar.index");
    }
    public function destroy(Car $AgencyCar)
    {
        $images=car_img::where("car_id",$AgencyCar->id)->get();
        Car::unlink_img($images);
        $CarBadges=car_badge::where('car_id', '=', $AgencyCar->id)->get();
        foreach($CarBadges as $key=>$badge){
            $badge->delete();
        }
        $CarFeatures=car_feature::where('car_id', '=', $AgencyCar->id)->get();
        foreach($CarFeatures as $key=>$feature){
            $feature->delete();
        }
        $AgencyCar->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.AgencyCar.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
                $car = Car::find($id);
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
                $agency=AgencyCar::where('car_id',$car->id)->first();
                $car->agencies()->detach([$agency->agency_id]);
                $car->delete();
			}
		} else {
            $car = Car::find(request('item'));
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
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.AgencyCar.index");
    }
}
