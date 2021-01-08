<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AgencyDatatable;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgencyDatatable $agency)
    {
        $page_title = __('Agency companies');
        $page_description = __('View Insurances');
        return  $agency->render("dashboard.Agency.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Agency");
        $page_description = __("Add new Agency");
        $countries = Country::all();
        $users     = User::all();
        return view('dashboard.Agency.add', compact('page_title', 'page_description','countries','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Agency::rules($request);
        $request->validate($rules);
        $credentials = Agency::credentials($request);
        $Agency = Agency::create($credentials);
        session()->flash('created',__("Agency has been Created successfully!"));
        return redirect()->route('dashboard.agency.index');
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
    public function edit($id)
    {
        $agency     = Agency::find($id);
        if($agency->count()){
        $countries  = Country::all();
        $users      = User::all();
        $page_title = __("Edit Agency");
        $page_description = __("Edit");
        return view('dashboard.agency.edit', compact('page_title', 'page_description','users','countries','agency'));
        }else{
            return redirect()->route('dashboard.agency.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agency = Agency::find($id);
        $rules  = Agency::rules($request,'Agency');
        $request->validate($rules);
        $credentials = Agency::credentials($request,$request->user_id,$agency->img_id);
        $Agency = Agency::where('id',$id)->update($credentials);
        session()->flash('updated',__("Agency has been Updated successfully!"));
        return redirect()->route('dashboard.agency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        $agency->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.agency.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$agency = Agency::find($id);
				$agency->delete();
			}
		} else {
			$agency = Agency::find(request('item'));
			$agency->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.agency.index");
    }
}
