<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;
use App\DataTables\GovernorateDatatable;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GovernorateDatatable $governorate)
    {
        $page_title = __('Governorates');
        $page_description = __('View Governorates');
        return  $governorate->render("dashboard.Governorate.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = "Add Governorate";
        $page_description = "Add new Governorate";
        $countries = Country::all();
        return view('dashboard.Governorate.add', compact('page_title', 'page_description','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Governorate::rules($request);
        $request->validate($rules);
        $credentials = Governorate::credentials($request);
        $Governorate = Governorate::create($credentials);
        session()->flash('created',__("Changed has been Created successfully!"));
        return redirect()->route("dashboard.governorate.index");
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

        $page_title = "Edit governorate";
        $page_description = "Edit";
        $governorate = Governorate::find($id);
        $countries = Country::all();
        return view('dashboard.Governorate.edit', compact('page_title', 'page_description','governorate','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Governorate $governorate)
    {
        $rules =$governorate->rules($request);
        $request->validate($rules);
        $credentials = $governorate->credentials($request);
        $governorate->update($credentials);
        session()->flash('updated',__("Changed has been updated successfully!"));
        return  redirect()->route("dashboard.governorate.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.governorate.index");
    }
    public function Activity(Request $request){
        $country = Governorate::find($request->id);
        $country->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$governorate = Governorate::find($id);
				$governorate->delete();
			}
		} else {
			$governorate = Governorate::find(request('item'));
			$governorate->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.governorate.index");
    }
}
