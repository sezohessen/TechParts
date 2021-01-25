<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarColor;
use Illuminate\Http\Request;
use App\DataTables\CarColorDatatable;
class CarColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarColorDatatable $color)
    {
        $page_title = __('Car Color');
        $page_description = __('View Colors Codes');
        return  $color->render("dashboard.CarColor.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Car Color");
        $page_description = __("Car Color");

        return view('dashboard.CarColor.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = CarColor::rules($request);
        $request->validate($rules);
        $credentials = CarColor::credentials($request);
        $CarColor = CarColor::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.color.index");
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
    public function edit(CarColor $color)
    {
        $page_title = __("Edit Car Color");
        $page_description = __("Edit Color");

        return view('dashboard.CarColor.edit', compact('page_title', 'page_description','color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarColor $color)
    {
        $rules =$color->rules($request);
        $request->validate($rules);
        $credentials = $color->credentials($request);
        $color->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return redirect()->route("dashboard.color.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarColor $color)
    {
        $color->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.color.index");
    }
    public function Activity(Request $request){
        $color = CarColor::find($request->id);
        $color->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$color = CarColor::find($id);
				$color->delete();
			}
		} else {
			$color = CarColor::find(request('item'));
			$color->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.color.index");
    }
}
