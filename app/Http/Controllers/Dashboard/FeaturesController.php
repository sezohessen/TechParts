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
         /* if (Session::get('app_locale') == 'ar') {
            $page_title = "اضافة ميزة";
            $page_description = "اضافة ميزة جديدة";
        } else {
            $page_title = "Add Feature";
            $page_description = "Add new Feature";
        } */
        $page_title = "Add Feature";
        $page_description = "Add new Feature";
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
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة الخاصية"));
        } else {
            session()->flash('success',__("Feature has been added!"));
        } */
       session()->flash('success',__("Feature has been added!"));
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "تعديل الخاصية";
            $page_description = "تعديل";
        } else {
            $page_title = "Edit Feature";
            $page_description = "Edit";
        } */
        $page_title = "Edit Feature";
        $page_description = "Edit";
        $feature = Feature::find($id);
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
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل الخاصية"));
        } else {
            session()->flash('success',__("Feature has been updated!"));
        } */
      session()->flash('updated',__("Changed has been updated successfully!"));
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
        /* $Feature = Feature::find($id);
        if($Feature!=null){
            $Feature->delete($id);
             if (Session::get('app_locale') == 'ar') {
            session()->flash('delete',__(" تم الحذف بنجاح!  "));
            } else {
                session()->flash('delete',__("Row has been deleted successfully!"));
            }
            session()->flash('delete', 'Row has been deleted successfully!');
            return redirect()->route('feature.index');
        }else{
            return redirect()->back();
        } */
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
				$feature->delete();
			}
		} else {
			$feature = Feature::find(request('item'));
			$feature->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.feature.index");
    }
}
