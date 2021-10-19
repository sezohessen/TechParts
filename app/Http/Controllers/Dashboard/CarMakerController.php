<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarMaker;
use Illuminate\Http\Request;
use App\DataTables\CarMakeDatatable;
use App\Models\CarClassification;

class CarMakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarMakeDatatable $maker)
    {
        $page_title = __('Companies');
        $page_description = __('View manufacturing');
        return  $maker->render("dashboard.CarMaker.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title         = __("Add company name");
        $page_description   = __("Company name");
        $Classes            = CarClassification::all();
        return view('dashboard.CarMaker.add', compact('page_title', 'page_description','Classes'));
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
        session()->flash('created',__("Changes has been Created Successfully"));
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
        $page_title         = __("Edit Car Make");
        $page_description   = __("Edit Make");
        $Classes            = CarClassification::all();

        return view('dashboard.CarMaker.edit', compact('page_title', 'page_description','maker','Classes'));
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
        session()->flash('updated',__("Changes has been Updated Successfully"));
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
