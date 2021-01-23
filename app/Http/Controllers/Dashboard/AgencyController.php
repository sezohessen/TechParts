<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AgencyDatatable;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\AgencyCar;
use App\Models\AgencyCarMaker;
use App\Models\AgencyContact;
use App\Models\AgencySpecialties;
use App\Models\CarMaker;
use App\Models\Country;
use App\Models\Specialties;
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
        $page_title       = __("Add Agency");
        $page_description = __("Add new Agency");
        $countries        = Country::all();
        $users            = User::all();
        $car_makers       = CarMaker::all();
        $specialties      = Specialties::all();
        return view('dashboard.Agency.add', compact('page_title', 'page_description'
        ,'countries','users','car_makers','specialties'));
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
        $rules          = Agency::rules($request);
        $request->validate($rules);
        $credentials    = Agency::credentials($request);
        $Agency         = Agency::create($credentials);
        //After Creating Agency row ,Agency Contact will be created by adding the agency id
        //Validate and create for AgencyContact Table
        $agent_id       = $Agency->id;
        $rules          = AgencyContact::rules($request);
        $request->validate($rules);
        $credentials    = AgencyContact::credentials($request,$agent_id);
        $AgencyContact  = AgencyContact::create($credentials);
        //Validate and create for AgencyCar Table
        $rules          = AgencyCarMaker::rules($request);
        $request->validate($rules);
        //Get car_maker Array to Agency Car
        foreach ($request->CarMaker_id as $CarMaker_id){
            $credentials    = AgencyCarMaker::credentials($CarMaker_id,$agent_id);
            $AgencyCar      = AgencyCarMaker::create($credentials);
        }
        //Validation completed in Agency Depends on center_type

        //Get car_id Array to Agency Car
        $Specialty_Lists = 0;
        if($request->center_type==1){
            $Specialty_Lists    = $request->specialty_id;
        }elseif($request->center_type==2){
            $Specialty_Lists    = $request->specialty_id_spare;
        }
        if($Specialty_Lists){
            foreach ($Specialty_Lists as $specialty_id){
                $credentials    = AgencySpecialties::credentials($specialty_id,$agent_id);
                $Specialties    = AgencySpecialties::create($credentials);
            }
        }
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
        $agency              = Agency::find($id);
        if($agency->count()){
        $countries           = Country::all();
        $users               = User::all();
        $specialties        = Specialties::all();
        $agency_contact      = AgencyContact::where('agent_id',$id)->first();
        $page_title          = __("Edit Agency");
        $page_description    = __("Edit");
        $car_makers          = CarMaker::all();
        $car_makers_selected = AgencyCarMaker::where('agency_id',$id)->get();
        //Add Agency Cars Id in array
        //I will Collect all selectd car to compare it
        $SelectedCarMakers = [];

        foreach($car_makers_selected as $carMaker)
        {
            $SelectedCarMakers[] = $carMaker->CarMaker_id;
        }
        $agency_specialties_selected    = AgencySpecialties::where('agency_id',$id)->get();
        $agency_specialties_Main        = [];
        $agency_specialties_Spare       = [];
        if($agency_specialties_selected->count()){
            if($agency->center_type == Agency::center_type_Maintenance){
                foreach($agency_specialties_selected as $specialty)
                {
                    $agency_specialties_Main[] = $specialty->specialty_id;
                }
            }elseif($agency->center_type == Agency::center_type_Spare){
                foreach($agency_specialties_selected as $specialty)
                {
                    $agency_specialties_Spare[] = $specialty->specialty_id;
                }
            }

        }
        return view('dashboard.Agency.edit', compact('page_title', 'page_description','users'
        ,'countries','agency','agency_contact','car_makers','SelectedCarMakers','agency_specialties_Spare'
        ,'agency_specialties_Main','specialties'));
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
        $agency         = Agency::find($id);
        $OldSpecialties = $agency->maintenance_type;
        $rules          = Agency::rules($request,'Agency');
        $request->validate($rules);
        $credentials    = Agency::credentials($request,$request->user_id,$agency->img_id);
        $Agency         = Agency::where('id',$id)->update($credentials);
        //After Creating Agency row ,Agency Contact will be created by adding the agency id
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
        $AgencyCarMakers     = AgencyCarMaker::where('agency_id',$id)->get();
        $SelectedCarMaker = [];
        foreach($AgencyCarMakers as $AgencyMaker){
            $SelectedCarMaker[] = $AgencyMaker->CarMaker_id;
        }
        $NeedToBeDeleted = array_diff($SelectedCarMaker,$request->CarMaker_id);
        $NeedToBeCreated = array_diff($request->CarMaker_id,$SelectedCarMaker);
        //Validate and create for AgencyCar Table
        $rules          = AgencyCarMaker::rules($request);
        $request->validate($rules);
        //Get car_id Array to Agency Car , (Create New)
        foreach ($NeedToBeCreated as $CarMaker_id){
            $credentials    = AgencyCarMaker::credentials($CarMaker_id,$id);
            $AgencyCar      = AgencyCarMaker::create($credentials);
        }
        //Delete Removed Selected
        foreach ($NeedToBeDeleted as $CarMaker_id){
            $AgencyCar      = AgencyCarMaker::where([
                ['CarMaker_id','=',$CarMaker_id],
                ['agency_id','=',$id]
            ])->delete();
        }
        //Center Type Update
        /* //Short Description
        There are 3 Condition
        1- if the comming request is Agency then i will delete all the specialty record
        2- if the comming request is Maintenance then i will have also 2 condition
            1- if the specialty old values is Maintenance then i will get the diffrence between the old and the new
            2- if the specialty old values is Spare then i will delete all old values and create all comming request
        3- if the comming request is Spare then i will have also 2 condition
            1- if the specialty old values is Spare then i will get the diffrence between the old and the new
            2- if the specialty old values is Maintenance then i will delete all old values and create all comming request
        */
        if($request->center_type==Agency::center_type_Agency){
            $NeedToBeDeleted    = AgencySpecialties::where('agency_id',$id)->get();
            if($NeedToBeDeleted->count()){
                foreach ($NeedToBeDeleted as $agencySpecailty){
                    $AgencySpecialization = AgencySpecialties::where([
                        ['specialty_id','=',$agencySpecailty->specialty_id],
                        ['agency_id','=',$id]
                    ])->delete();
                }
            }
        }else{
            $AgencySpecialization   = AgencySpecialties::where('agency_id',$id)->get();
            $SelectedSpecialization = [];
            foreach($AgencySpecialization as $AgencySpecialty){
                $SelectedSpecialization[] = $AgencySpecialty->specialty_id;
            }
            if($OldSpecialties){
                if($request->center_type==Agency::center_type_Maintenance){
                    $NeedToBeDeleted = array_diff($SelectedSpecialization,$request->specialty_id);
                    $NeedToBeCreated = array_diff($request->specialty_id,$SelectedSpecialization);
                    //Validation completed in Agency Depends on center_type

                    //Get Specailty Array to AgencySpecialization , (Create New)
                    foreach ($NeedToBeCreated as $specailty){
                        $credentials        = AgencySpecialties::credentials($specailty,$id);
                        $AgencySpecialties  = AgencySpecialties::create($credentials);
                    }
                    //Delete Removed Selected
                    foreach ($NeedToBeDeleted as $agencySpecailty){
                        $AgencySpecialization = AgencySpecialties::where([
                            ['specialty_id','=',$agencySpecailty],
                            ['agency_id','=',$id]
                        ])->delete();
                    }
                }else{
                    $NeedToBeDeleted = $SelectedSpecialization;
                    $NeedToBeCreated = $request->specialty_id_spare;
                    //Validation completed in Agency Depends on center_type

                    //Get Specailty Array to AgencySpecialization , (Create New)
                    foreach ($NeedToBeCreated as $specailty){
                        $credentials        = AgencySpecialties::credentials($specailty,$id);
                        $AgencySpecialties  = AgencySpecialties::create($credentials);
                    }
                    //Delete Removed Selected
                    foreach ($NeedToBeDeleted as $agencySpecailty){
                        $AgencySpecialization = AgencySpecialties::where([
                            ['specialty_id','=',$agencySpecailty],
                            ['agency_id','=',$id]
                        ])->delete();
                    }
                }
            }else{
                if($request->center_type==Agency::center_type_Maintenance){
                    $NeedToBeDeleted = $SelectedSpecialization;
                    $NeedToBeCreated = $request->specialty_id;
                    //Get Specailty Array to AgencySpecialization , (Create New)
                    foreach ($NeedToBeCreated as $specailty){
                        $credentials        = AgencySpecialties::credentials($specailty,$id);
                        $AgencySpecialties  = AgencySpecialties::create($credentials);
                    }
                    //Delete Removed Selected
                    foreach ($NeedToBeDeleted as $agencySpecailty){
                        $AgencySpecialization = AgencySpecialties::where([
                            ['specialty_id','=',$agencySpecailty],
                            ['agency_id','=',$id]
                        ])->delete();
                    }
                }else{
                    $NeedToBeDeleted = array_diff($SelectedSpecialization,$request->specialty_id_spare);
                    $NeedToBeCreated = array_diff($request->specialty_id_spare,$SelectedSpecialization);
                    //Validation completed in Agency Depends on center_type

                    //Get Specailty Array to AgencySpecialization , (Create New)
                    foreach ($NeedToBeCreated as $specailty){
                        $credentials        = AgencySpecialties::credentials($specailty,$id);
                        $AgencySpecialties  = AgencySpecialties::create($credentials);
                    }
                    //Delete Removed Selected
                    foreach ($NeedToBeDeleted as $agencySpecailty){
                        $AgencySpecialization = AgencySpecialties::where([
                            ['specialty_id','=',$agencySpecailty],
                            ['agency_id','=',$id]
                        ])->delete();
                    }
                }
            }
        }
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
    public function Status(Request $request){
        $agency = Agency::find($request->id);
        $agency->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
}
