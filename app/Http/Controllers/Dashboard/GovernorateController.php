<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;
use App\DataTables\GovernorateDatatable;
use App\Models\City;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GovernorateDatatable $governorate)
    {
        $page_title         = __('Governorates');
        $page_description   = __('View Governorates');
        return  $governorate->render("dashboard.Governorate.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title         = __("Add Governorate");
        $page_description   = __("Add new Governorate");
        return view('dashboard.Governorate.add', compact('page_title', 'page_description'));
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
        session()->flash('created',__("Changes has been Created Successfully"));
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
        $cities = City::where('governorate_id', $id)->get();
        if($cities->count() > 0 ){
            return response()->json([
                'cities' => $cities
            ]);
        }
        return response()->json([
            'cities' => null
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

        $page_title         = __("Edit governorate");
        $page_description   = __("Edit");
        $governorate        = Governorate::find($id);
        if($governorate)return view('dashboard.Governorate.edit', compact('page_title', 'page_description','governorate'));
        else return redirect()->route('dashboard.governorate.index');
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
        session()->flash('updated',__("Changes has been Updated Successfully"));
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
