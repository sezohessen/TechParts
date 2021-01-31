<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Car;
use App\Models\User;
use App\Models\Image;
use App\Models\Agency;
use App\Models\promote;
use App\Models\CarMaker;
use App\Models\PromoteCar;
use App\Models\ListCarUser;
use Illuminate\Http\Request;
use App\Models\subscribe_package;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\CarPromoteDatatable;

class CarPromoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarPromoteDatatable $promote)
    {
        $page_title = __("Promotions");
        $page_description =__( "View Promotions");
        return  $promote->render("dashboard.CarPromote.index", compact('page_title', 'page_description'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = __("Pomote a car");
        $page_description = __("Pomote a car");
        $cars=Car::where("status","=",1)->get();
        $packages=subscribe_package::all();
        return view('dashboard.CarPromote.add', compact("packages","cars",'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = PromoteCar::rules($request);
        $request->validate($rules);
        $credentials = PromoteCar::credentials($request);
        PromoteCar::create($credentials);
        session()->flash('created',__("Changes has been Created successfully"));
        return redirect()->route("dashboard.promote.index");

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
    public function edit(PromoteCar $promote)
    {
        $page_title = __("Edit Promotion");
        $page_description = __("Edit Promotion");
        $cars=Car::where("status","=",1)->get();
        $packages=subscribe_package::all();
        return view('dashboard.CarPromote.edit', compact('page_title', 'page_description',"promote","cars","packages"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromoteCar $promote)
    {

        $rules = $promote->rules($request);
        $request->validate($rules);
        $credentials = $promote->credentials($request);
        $promote->update($credentials);
        session()->flash('created',__("Changes has been Updated successfully!"));
        return redirect()->route("dashboard.promote.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoteCar $promote)
    {
        $promote->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.promote.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$promote = PromoteCar::find($id);
				$promote->delete();
			}
		} else {
			$promote = PromoteCar::find(request('item'));
			$promote->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.promote.index");
    }
}
