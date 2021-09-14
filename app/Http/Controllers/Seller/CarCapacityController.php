<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\CarCapacity;
use Illuminate\Http\Request;
use App\DataTables\CarCapacityDatatable;
class CarCapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Car Capacity");
        $page_description = __("Car Capacity");

        return view('SellerDashboard.CarCapacity.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = CarCapacity::rules($request);
        $request->validate($rules);

        $isExist    = CarCapacity::where('capacity',$request->capacity)->where('capacity',$request->capacity)->first() ? true: false;
        if($isExist){
            session()->flash('exist',__("This engine capacity is already exist"));
            return redirect()->back();
        }
        else {
            $credentials = CarCapacity::credentials($request);
            $Carcapacity = CarCapacity::create($credentials);
            session()->flash('created',__("Changes has been Created Successfully"));
            return redirect()->route("seller.car.create");
        }

    }
}
