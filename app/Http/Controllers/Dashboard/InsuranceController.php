<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\InsuranceDatatable;
use Illuminate\Support\Facades\Auth;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InsuranceDatatable  $insurance )
    {
        $page_title = __('Insurance company');
        $page_description = __('View Insurances');
        return  $insurance->render("dashboard.Insurance.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = __("Add insurance company");
        $page_description = __("Add new insurance company");
        $users = User::all();
        return view('dashboard.Insurance.add', compact('page_title', 'page_description','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Insurance::rules($request);
        $request->validate($rules);
        $credentials = Insurance::credentials($request);
        $Insurance = Insurance::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.insurance.index");
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
        $offers = Insurance_offer::where('insurance_id', $id)->get();
        if($offers->count() > 0 ){
            return response()->json([
                'insurance_offers' => $offers
            ]);
        }
        return response()->json([
            'insurance_offers' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insurance = Insurance::find($id);
        if($insurance){
        $users = User::all();
        $page_title = __("Edit Insurance");
        $page_description = __("Edit");
        return view('dashboard.Insurance.edit', compact('page_title', 'page_description','users','insurance'));
        }else{
            return redirect()->route('dashboard.insurance.index');
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
        $insurance = Insurance::find($id);
        $rules = Insurance::rules($request,'Insurance');
        $request->validate($rules);
        $credentials = Insurance::credentials($request,$request->user_id,$insurance->img_id);
        $Insurance = Insurance::where('id',$id)->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.insurance.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurance $insurance)
    {
        $insurance->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.insurance.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
                $insurance = Insurance::find($id);
                if($insurance)
				    $insurance->delete();
			}
		} else {
            $insurance = Insurance::find(request('item'));
            if($insurance)
			    $insurance->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.insurance.index");
    }
}
