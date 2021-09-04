<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarYear;
use Illuminate\Http\Request;
use App\DataTables\CarYearDatatable;
use App\Models\CarModel;

class CarYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarYearDatatable $year)
    {
        $page_title = __('Years of manufacture');
        $page_description = __('View Available Years');
        return  $year->render("dashboard.CarYear.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add a year of manufacture");
        $page_description = __("Years of manufacture");
        $models=CarModel::all();
        return view('dashboard.CarYear.add', compact('page_title', 'page_description','models'));
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
            return redirect()->route("dashboard.year.index");
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
    public function edit(CarYear $year)
    {
        $page_title         = __("Edit a year of manufacture");
        $page_description   = __("Years of manufacture");
        $models             = CarModel::all();
        return view('dashboard.CarYear.edit', compact('page_title', 'page_description','year','models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarYear $year)
    {
        $rules =$year->rules($request);
        $request->validate($rules);
        $credentials = $year->credentials($request);
        $year->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return redirect()->route("dashboard.year.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarYear $year)
    {
        $year->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.year.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$year = CarYear::find($id);
				$year->delete();
			}
		} else {
			$year = CarYear::find(request('item'));
			$year->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.year.index");
    }
}
