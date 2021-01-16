<?php

namespace App\Http\Controllers\Agency;
use App\Http\Controllers\Controller;

use App\Models\Agency;
use App\Models\AgencyCar;
use App\Models\AgencyContact;
use App\Models\CarMaker;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\Agency\AgencyDatatable;
class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgencyDatatable $agency)
    {
        /* $page_title = __('Agency companies');
        $page_description = __('View Insurances');
        return  $agency->render("AgencyDashboard.Agency.index", compact('page_title', 'page_description')); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agency           = Agency::where('user_id',Auth::id())->first();
        if($agency!=NULL){
            return $this->edit($agency->id);
        }else{
            $page_title       = __("Add Agency");
            $page_description = __("Add new Agency");
            $countries        = Country::all();
            $car_makers       = CarMaker::all();
            return view('AgencyDashboard.Agency.add', compact('page_title', 'page_description','countries','car_makers'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate and create for Agency Table
        $rules          = Agency::rules($request,'AgencyDash');
        $request->validate($rules);
        //Forth parameter to avoid check box that in agency dashboad
        $credentials    = Agency::credentials($request,Auth::id(),NULL,0);
        $Agency         = Agency::create($credentials);
        //After Creating Agency row ,Agency Contact will be created by adding the agency id
        //Validate and create for AgencyContact Table
        $agent_id       = $Agency->id;
        $rules          = AgencyContact::rules($request);
        $request->validate($rules);
        $credentials    = AgencyContact::credentials($request,$agent_id);
        $AgencyContact  = AgencyContact::create($credentials);
        //Validate and create for AgencyCar Table
        $rules          = AgencyCar::rules($request);
        $request->validate($rules);
        //Get car_id Array to Agency Car
        foreach ($request->CarMaker_id as $CarMaker_id){
            $credentials    = AgencyCar::credentials($CarMaker_id,$agent_id);
            $AgencyCar      = AgencyCar::create($credentials);
        }
        session()->flash('created',__("Agency has been Created successfully!"));
        return redirect()->route('agency.index');
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
        $agency              = Agency::find($id);
        if($agency!=NULL && Auth::id() ==$agency->user_id){
        $countries           = Country::all();
        $agency_contact      = AgencyContact::where('agent_id',$id)->first();
        $page_title          = __("Edit Agency");
        $page_description    = __("Edit");
        $car_makers          = CarMaker::all();
        $car_makers_selected = AgencyCar::where('agent_id',$id)->get();
        //Add Agency Cars Id in array
        //I will Colled all selectd car to compare it
        $SelectedCarMakers = [];
        foreach($car_makers_selected as $carMaker)
        {
            $SelectedCarMakers[] = $carMaker->CarMaker_id;
        }
        return view('AgencyDashboard.Agency.edit', compact('page_title', 'page_description'
        ,'countries','agency','agency_contact','car_makers','SelectedCarMakers'));
        }else{
            return redirect()->route('agency.index');
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
        $agency         = Agency::find($id);
        $rules          = Agency::rules($request,$id);
        $request->validate($rules);
        //Forth parameter to avoid check box that in agency dashboad
        $credentials    = Agency::credentials($request,Auth::id(),$agency->img_id,0);
        $Agency         = Agency::where('id',$id)->update($credentials);
        //After Creating Agency row ,Agency Contact will be created by adding the dagency id
        $rules          = AgencyContact::rules($request);
        $request->validate($rules);
        $credentials    = AgencyContact::credentials($request,$id);
        $AgencyContact  = AgencyContact::where('agent_id',$id)->update($credentials);
        /* (Testing)
        $a = ['1','2','3'];//Selected
        $b = ['4','5','6','7'];//New Selected
        $difference = array_diff($a, $b);
        */

        //Array Differnce compute difference between to arrays
        //if Get Array diff between Selected and New select ,then It will return the array that I need to delete
        //if Get Array diff between New select and Selected ,then It will return the array that I need to create
        $AgencyCars     = AgencyCar::where('agent_id',$id)->get();
        $SelectedCarMaker = [];
        foreach($AgencyCars as $AgencyCar){
            $SelectedCarMaker[] = $AgencyCar->CarMaker_id;
        }

        $NeedToBeDeleted = array_diff($SelectedCarMaker,$request->CarMaker_id);
        $NeedToBeCreated = array_diff($request->CarMaker_id,$SelectedCarMaker);
        //Validate and create for AgencyCar Table
        $rules          = AgencyCar::rules($request);
        $request->validate($rules);
        //Get car_id Array to Agency Car , (Create New)
        foreach ($NeedToBeCreated as $CarMaker_id){
            $credentials    = AgencyCar::credentials($CarMaker_id,$id);
            $AgencyCar      = AgencyCar::create($credentials);
        }
        //Delete Removed Selected
        foreach ($NeedToBeDeleted as $CarMaker_id){
            $AgencyCar      = AgencyCar::where([
                ['CarMaker_id','=',$CarMaker_id],
                ['agent_id','=',$id]
            ])->delete();
        }
        session()->flash('updated',__("Agency has been Updated successfully!"));
        return redirect()->route('agency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
