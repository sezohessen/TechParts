<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\DataTables\FeatureDatatable;
class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FeatureDatatable $feature)
    {
        $page_title = __('Features');
        $page_description = __('View Features');
        return  $feature->render("dashboard.Feature.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Feature");
        $page_description = __("Add new Feature");
        return view('dashboard.Feature.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Feature::rules($request);
        $request->validate($rules);
        $credentials = Feature::credentials($request);
        $Feature = Feature::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.feature.index");
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
    public function edit(Feature $feature)
    {
        $page_title = __("Edit Feature");
        $page_description = __("Edit");
        return view('dashboard.Feature.edit', compact('page_title', 'page_description','feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $rules = Feature::rules($request);
        $request->validate($rules);
        $credentials = Feature::credentials($request);
        $Feature = $feature->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return redirect()->route("dashboard.feature.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.feature.index");
    }
    public function Activity(Request $request){
        $category = Feature::find($request->id);
        $category->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function multi_delete(){
    
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
                $feature = Feature::find($id);
                if($feature)
				    $feature->delete();
			}
		} else {
            $feature = Feature::find(request('item'));
            if($feature)
			    $feature->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.feature.index");
    }
}
