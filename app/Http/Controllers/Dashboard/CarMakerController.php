<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarMaker;
use Illuminate\Http\Request;
use App\DataTables\CarMakeDatatable;
class CarMakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarMakeDatatable $maker)
    {
        $page_title = __('Car Maker');
        $page_description = __('View CarMakers');
        return  $maker->render("dashboard.CarMaker.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Car Make");
        $page_description = __("Car Make");

        return view('dashboard.CarMaker.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = CarMaker::rules($request);
        $request->validate($rules);
        $credentials = CarMaker::credentials($request);
        $CarMaker = CarMaker::create($credentials);
        session()->flash('created',__("Changed has been Created successfully!"));
        return redirect()->route("dashboard.maker.index");
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
    public function edit(CarMaker $maker)
    {
        $page_title = __("Edit Car Make");
        $page_description = __("Edit Make");

        return view('dashboard.CarMaker.edit', compact('page_title', 'page_description','maker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarMaker $maker)
    {
        $rules =$maker->rules($request,$maker->id);
        $request->validate($rules);
        $credentials = $maker->credentials($request,$maker->logo->id);
        $maker->update($credentials);
        session()->flash('updated',__("Changed has been Updated successfully!"));
        return redirect()->route("dashboard.maker.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarMaker $maker)
    {
        $maker->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.maker.index");
    }
    public function Activity(Request $request){
        $maker = CarMaker::find($request->id);
        $maker->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$maker = CarMaker::find($id);
				$maker->delete();
			}
		} else {
			$maker = CarMaker::find(request('item'));
			$maker->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.maker.index");
    }
}
