<?php

namespace App\Http\Controllers\Seller;
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

    public function create()
    {

        $page_title         = __("Add Car");
        $page_description   = __("Add new Car");
        $makers             = CarMaker::all();
        $capacities         = CarCapacity::all();
        $models             = CarModel::all();
        $years              = CarYear::all();
        return view('SellerDashboard.Car.add', compact('page_title', 'page_description','makers','capacities'
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
            $credentials    = Car::credentials($request);
            $car            = Car::create($credentials);
            session()->flash('created',__("Changes has been Created Successfully"));
            return redirect()->route("seller.part.create");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
