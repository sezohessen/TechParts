<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Badges;
use App\Models\Car;
use App\Models\CarBody;
use App\Models\CarCapacity;
use App\Models\CarColor;
use App\Models\CarMaker;
use App\Models\CarManufacture;
use App\Models\CarModel;
use App\Models\CarYear;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $models=CarModel::where('active', '=', 1)->get();
        $bodies=CarBody::all();
        $years=CarYear::all();
        $badges=Badges::where('active', '=', 1)->get();
        $features=Feature::where('active', '=', 1)->get();
        $countries=Country::all();
        $manufactures=CarManufacture::all();
        $capacities=CarCapacity::all();
        return view('dashboard.Car.add', compact('page_title', 'page_description','makers',
        'models',"years","bodies","badges","features","countries","manufactures","capacities"));
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
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$car = Car::find($id);
				$car->delete();
			}
		} else {
			$car = Car::find(request('item'));
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
