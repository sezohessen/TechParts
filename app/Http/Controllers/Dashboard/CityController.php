<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\DataTables\CityDatatable;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CityDatatable $city)
    {
        $page_title = __('Cities');
        $page_description = __('View Cities');
        return  $city->render("dashboard.City.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = __("Add City");
        $page_description = __("Add new City");
        $countries = Country::all();
        return view('dashboard.City.add', compact('page_title', 'page_description','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = City::rules($request);
        $request->validate($rules);
        $credentials = City::credentials($request);
        $City = City::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.city.index");
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

        $page_title =__("Edit country");
        $page_description = __("Edit");
        $city = City::find($id);
        $governorate=Governorate::find($city->governorate_id);
        $countries = Country::all();
        if($city)return view('dashboard.City.edit', compact('page_title', 'page_description','city',"countries","governorate"));
        else return redirect()->route('dashboard.city.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $rules =$city->rules($request);
        $request->validate($rules);
        $credentials = $city->credentials($request);
        $city->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.city.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.city.index");
    }
    public function Activity(Request $request){
        $country = City::find($request->id);
        $country->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
                $city = City::find($id);
                if($city)
				    $city->delete();
			}
		} else {
            $city = City::find(request('item'));
            if($city)
		    	$city->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.city.index");
    }
}
