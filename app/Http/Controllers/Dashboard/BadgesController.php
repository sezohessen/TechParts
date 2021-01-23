<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Badges;
use Illuminate\Http\Request;
use App\DataTables\BadgesDatatable;
class BadgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BadgesDatatable $badge)
    {
        $page_title = __('Bagdes');
        $page_description = __('View Bagdes');
        return  $badge->render("dashboard.Badge.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "اضافة شارة";
            $page_description = "اضافة شارة جديدة";
        } else {
            $page_title = "Add Bagdes";
            $page_description = "Add new Governorate";
        } */
        $page_title = "Add Bagdes";
        $page_description = "Add new Bagdes";
        return view('dashboard.Badge.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Badges::rules($request);
        $request->validate($rules);
        $credentials = Badges::credentials($request);
        $Badges = Badges::create($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة الميزة"));
        } else {
            session()->flash('success',__("Badge has been added!"));
        } */
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.category.index");
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
            $page_title = "تعديل الشارة";
            $page_description = "تعديل";
        } else {
            $page_title = "Edit Badge";
            $page_description = "Edit";
        } */
        $page_title = "Edit Badge";
        $page_description = "Edit";
        $Badge = Badges::find($id);
        return view('dashboard.Badge.edit', compact('page_title', 'page_description','Badge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Badges $badge)
    {
        $rules = Badges::rules($request);
        $request->validate($rules);
        $credentials = Badges::credentials($request);
        $Badges = $badge->update($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل الميزة"));
        } else {
            session()->flash('success',__("Badge has been updated!"));
        } */
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.badge.index");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Badges $badge)
    {
        $badge->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.badge.index");
       /*  $badge = Badges::find($id);
        if($badge->count()!=0){
            $badge->delete($id);
             if (Session::get('app_locale') == 'ar') {
            session()->flash('delete',__(" تم الحذف بنجاح!  "));
            } else {
                session()->flash('delete',__("Row has been deleted successfully!"));
            }
            session()->flash('delete', 'Row has been deleted successfully!');
            return redirect()->route('badge.index');
        }else{
            return redirect()->back();
        } */
    }
    public function Activity(Request $request){
        $country = Badges::find($request->id);
        $country->update(["active"=>$request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$badge = Badges::find($id);
				$badge->delete();
			}
		} else {
			$badge = Badges::find(request('item'));
			$badge->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.badge.index");
    }
}
