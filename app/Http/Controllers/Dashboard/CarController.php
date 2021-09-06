<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Car;
use App\Models\City;
use App\Models\User;
use App\Models\Image;
use App\Models\CarYear;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use Illuminate\Http\Request;
use App\DataTables\CarDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarDatatable $car)
    {
        $page_title = __('Cars Options');
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

        $page_title         = __("Add Car");
        $page_description   = __("Add new Car");
        $makers             = CarMaker::all();
        $capacities         = CarCapacity::all();
        $models             = CarModel::all();
        $years              = CarYear::all();
        return view('dashboard.Car.add', compact('page_title', 'page_description','makers','capacities'
        ,'models','years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules      = Car::rules($request);
        $request->validate($rules);
        $isExist    = Car::where('CarMaker_id',$request->CarMaker_id)
        ->where('CarModel_id',$request->CarModel_id)
        ->where('CarYear_id',$request->CarYear_id)
        ->where('CarCapacity_id',$request->CarCapacity_id)->first();
        if($isExist){
            session()->flash('exist',__("This car is already exist"));
            return redirect()->back();
        }else{
            $credentials = Car::credentials($request);
            $car = Car::create($credentials);
            session()->flash('created',__("Changes has been Created Successfully"));
            return redirect()->route("dashboard.car.index");
        }

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
        $makers             = CarMaker::all();
        $capacities         = CarCapacity::all();
        $models             = CarModel::all();
        $years              = CarYear::all();

        return view('dashboard.Car.edit', compact('page_title', 'page_description','car','makers','capacities'
        ,'models','years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {

        $rules      = Car::rules($request,true);
        $request->validate($rules);
        $isExist    = Car::where('id','!=',$car->id)
        ->where('CarMaker_id',$request->CarMaker_id)
        ->where('CarModel_id',$request->CarModel_id)
        ->where('CarYear_id',$request->CarYear_id)
        ->where('CarCapacity_id',$request->CarCapacity_id)->first();
        if($isExist){
            session()->flash('exist',__("This car is already exist"));
            return redirect()->back();
        }else{
            $credentials = Car::credentials($request);
            $car->update($credentials);
            session()->flash('updated',__("Changes has been Created Successfully"));
            return redirect()->route("dashboard.car.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.car.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$maker = Car::find($id);
				$maker->delete();
			}
		} else {
			$maker = Car::find(request('item'));
			$maker->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.car.index");
    }
    public function available_model($id){
        $models = CarModel::where('CarMaker_id', $id)->get();
        if($models->count() > 0 ){
            return response()->json([
                'models' => $models
            ]);
        }
        return response()->json([
                'models' => null
        ]);
    }
    public function available_year($id){
        $years = CarYear::where('CarModel_id', $id)->get();
        if($years->count() > 0 ){
            return response()->json([
                'years' => $years
            ]);
        }
        return response()->json([
                'years' => null
        ]);
    }
}
