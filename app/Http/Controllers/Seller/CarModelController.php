<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\CarMaker;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\DataTables\CarModelDatatable;
class CarModelController extends Controller
{


    public function create()
    {
        $page_title         = __("Add Car Model");
        $page_description   = __("Car Model");
        $makers             = CarMaker::all();
        return view('SellerDashboard.CarModel.add', compact('page_title', 'page_description',"makers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules      = CarModel::rules($request);
        $request->validate($rules);
        $isExist    = CarModel::where('name',$request->name)->where('CarMaker_id',$request->CarMaker_id)->first() ? true: false;
        if($isExist){
            session()->flash('exist',__("This car model is already exist"));
            return redirect()->back();
        }
        else {
            $credentials = CarModel::credentials($request);
            $CarModel = CarModel::create($credentials);
            session()->flash('created',__("Changes has been Created Successfully"));
            return redirect()->route("seller.year.create");
        }

    }

}
