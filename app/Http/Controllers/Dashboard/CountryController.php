<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use App\DataTables\CountryDatatable;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDatatable $country)
    {
        $page_title = __('Countries');
        $page_description = __('View countries');
        return  $country->render("dashboard.Country.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = "Add country";
        $page_description = "Add new country";

        return view('dashboard.Country.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Country::rules($request);
        $request->validate($rules);
        $credentials = Country::credentials($request);
        $Country = Country::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return  redirect()->route("dashboard.country.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $governorates = Governorate::where('country_id', $id)->get();
        if($governorates->count() > 0 ){
            return response()->json([
                'governorates' => $governorates
            ]);
        }
        return response()->json([
            'governorates' => null
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

        $page_title = "Edit country";
        $page_description = "Edit";
        $country = Country::find($id);
        return view('dashboard.Country.edit', compact('page_title', 'page_description','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $rules =$country->rules($request);
        $request->validate($rules);
        $credentials = $country->credentials($request);
        $country->update($credentials);
        session()->flash('updated',__("Changed has been updated successfully!"));
        return  redirect()->route("dashboard.country.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        if($country!=null){
            $country->delete($id);
            session()->flash('delete', 'Row has been deleted successfully!');
            return redirect()->route('country.index');
        }else{
            return redirect()->back();
        }
    }
    public function Activity(Request $request){
        $country = Country::find($request->id);
        $country->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
}
