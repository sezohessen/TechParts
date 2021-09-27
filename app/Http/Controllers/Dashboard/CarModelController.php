<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarMaker;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\DataTables\CarModelDatatable;
class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarModelDatatable $model)
    {
        $page_title = __('Car Models');
        $page_description = __('View Car Models');
        return  $model->render("dashboard.CarModel.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title         = __("Add Car Model");
        $page_description   = __("Car Model");
        $makers             = CarMaker::all();
        return view('dashboard.CarModel.add', compact('page_title', 'page_description',"makers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules      = CarModel::rules($request);
        $request->validate($rules);
        $isExist    = CarModel::where('name',$request->name)->where('CarMaker_id',$request->CarMaker_id)->first() ? true: false;
        if($isExist){
            session()->flash('exist',__("This car model is already exist"));
            return redirect()->back();
        }
        else {
            $credentials = CarModel::credentials($request);
            $CarModel = CarModel::create($credentials);
            session()->flash('created',__("Changes has been Created Successfully"));
            return redirect()->route("dashboard.model.index");
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
    public function edit(CarModel $model)
    {
        $page_title         = __("Edit Car Model");
        $page_description   = __("Edit Model");
        $makers             = CarMaker::all();
        return view('dashboard.CarModel.edit', compact('page_title', 'page_description','model','makers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarModel $model)
    {
        $rules =$model->rules($request,$model->id);
        $request->validate($rules);
        $credentials = $model->credentials($request);
        $model->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return redirect()->route("dashboard.model.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarModel $model)
    {
        $model->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.model.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$model = CarModel::find($id);
				$model->delete();
			}
		} else {
			$model = CarModel::find(request('item'));
			$model->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.model.index");
    }
}
