<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\InsuranceDatatable;
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

        $page_title = "Add insurance company";
        $page_description = "Add new insurance company";
        $users = User::all();
        return view('dashboard.insurance.add', compact('page_title', 'page_description','users'));
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
       session()->flash('success',__("Insurance company has been added!"));
       return redirect()->back();
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
        //
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
        //
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
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$insurance = Insurance::find($id);
				$insurance->delete();
			}
		} else {
			$insurance = Insurance::find(request('item'));
			$insurance->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.insurance.index");
    }
}
