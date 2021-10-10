<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CarClassDatatable;
use App\Http\Controllers\Controller;
use App\Models\CarClassification;
use Illuminate\Http\Request;

class CarClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarClassDatatable $class)
    {
        $page_title = __('Brand Classification');
        $page_description = __('View');
        return  $class->render("dashboard.CarClass.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Class");
        $page_description = __("Brand Class");

        return view('dashboard.CarClass.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = CarClassification::rules($request);
        $request->validate($rules);
        $credentials = CarClassification::credentials($request);
        $Carcapacity = CarClassification::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.class.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CarClassification $class)
    {
        $page_title = __("Edit Class");
        $page_description = __("Edit");

        return view('dashboard.CarClass.edit', compact('page_title', 'page_description','class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarClassification $class)
    {
        $rules          = $class->rules($request);
        $request->validate($rules);
        $credentials    = $class->credentials($request);
        $class->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return redirect()->route("dashboard.class.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarClassification $class)
    {
        $class->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.class.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$class = CarClassification::find($id);
				$class->delete();
			}
		} else {
			$class = CarClassification::find(request('item'));
			$class->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.class.index");
    }
}
