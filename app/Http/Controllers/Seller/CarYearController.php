<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\CarYear;
use Illuminate\Http\Request;
use App\DataTables\CarYearDatatable;
use App\Models\CarModel;

class CarYearController extends Controller
{

    public function create()
    {
        $page_title         = __("Add a year of manufacture");
        $page_description   = __("Years of manufacture");
        $models             = CarModel::all();
        return view('SellerDashboard.CarYear.add', compact('page_title', 'page_description','models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules      = CarYear::rules($request);
        $request->validate($rules);
        $isExist    = CarYear::where('year',$request->year)->where('CarModel_id',$request->CarModel_id)->first() ? true: false;
        if($isExist){
            session()->flash('exist',__("This year model already exist"));
            return redirect()->back();
        }
        else {
            $credentials    = CarYear::credentials($request);
            $Caryear        = CarYear::create($credentials);
            session()->flash('created',__("Changes has been Created Successfully"));
            return redirect()->route("seller.car.create");
        }
    }

}
