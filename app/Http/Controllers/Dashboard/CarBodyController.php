<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarBody;
use Illuminate\Http\Request;
use App\DataTables\CarBodyDatatable;
class CarBodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarBodyDatatable $body)
    {
        $page_title = __('Car Body');
        $page_description = __('View Bodies');
        return  $body->render("dashboard.CarBody.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Car Body");
        $page_description = __("Car Body");

        return view('dashboard.CarBody.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = CarBody::rules($request);
        $request->validate($rules);
        $credentials = CarBody::credentials($request);
        $CarMaker = CarBody::create($credentials);
        session()->flash('created',__("Changed has been Created successfully!"));
        return redirect()->route("dashboard.body.index");
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
    public function edit(CarBody $body)
    {
        $page_title = __("Edit Car Body");
        $page_description = __("Edit Body");

        return view('dashboard.CarBody.edit', compact('page_title', 'page_description','body'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarBody $body)
    {
        $rules =$body->rules($request,$body->id);
        $request->validate($rules);
        $credentials = $body->credentials($request,$body->logo->id);
        $body->update($credentials);
        session()->flash('updated',__("Changed has been Updated successfully!"));
        return redirect()->route("dashboard.body.index");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarBody $body)
    {
        $body->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.body.index");
    }
    public function Activity(Request $request){
        $body = CarBody::find($request->id);
        $body->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$maker = CarBody::find($id);
				$maker->delete();
			}
		} else {
			$maker = CarBody::find(request('item'));
			$maker->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.body.index");
    }
}
