<?php

namespace App\Http\Controllers\Dashboard;

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
    public function index(CarCapacityDatatable $capacity)
    {
        $page_title = __('Car Capacity');
        $page_description = __('View Capacities');
        return  $capacity->render("dashboard.CarCapacity.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Car Capacity");
        $page_description = __("Car Capacity");

        return view('dashboard.CarCapacity.add', compact('page_title', 'page_description'));
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
            return redirect()->route("dashboard.capacity.index");
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
    public function edit(CarCapacity $capacity)
    {
        $page_title = __("Edit Car Capacity");
        $page_description = __("Edit Capacity");

        return view('dashboard.CarCapacity.edit', compact('page_title', 'page_description','capacity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarCapacity $capacity)
    {
        $rules =$capacity->rules($request);
        $request->validate($rules);
        $credentials = $capacity->credentials($request);
        $capacity->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return redirect()->route("dashboard.capacity.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarCapacity $capacity)
    {
        $capacity->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.capacity.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$capacity = CarCapacity::find($id);
				$capacity->delete();
			}
		} else {
			$capacity = CarCapacity::find(request('item'));
			$capacity->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.capacity.index");
    }
}
