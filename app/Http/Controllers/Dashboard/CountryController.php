<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = 'البلدان';
            $page_description = 'عرض جميع البلدن';
        } else {
            $page_title = 'Countries';
            $page_description = 'View all countries';
        } */
        $page_title = 'Countries';
        $page_description = 'View all countries';
        $countries = Country::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.Country.index', compact('page_title', 'page_description','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "اضافة بلد";
            $page_description = "اضافة بلد جديدة";
        } else {
            $page_title = "Add country";
            $page_description = "Add new country";
        } */
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
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة البلد"));
        } else {
            session()->flash('success',__("Country has been added!"));
        } */
       session()->flash('success',__("Country has been added!"));
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
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "تعديل بلد";
            $page_description = "تعديل";
        } else {
            $page_title = "Edit country";
            $page_description = "Edit";
        } */
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
    public function update(Request $request, $id)
    {
        $rules = Country::rules($request);
        $request->validate($rules);
        $credentials = Country::credentials($request);
        $Country = Country::where('id',$id)->update($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل التغيرات بنجاح"));
        } else {
            session()->flash('success',__("Changed has been updated successfully!"));
        } */
       session()->flash('success',__("Changed has been updated successfully!"));
       return redirect()->back();
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
            /* if (Session::get('app_locale') == 'ar') {
            session()->flash('delete',__(" تم الحذف بنجاح!  "));
            } else {
                session()->flash('delete',__("Row has been deleted successfully!"));
            } */
            session()->flash('delete', 'Row has been deleted successfully!');
            return redirect()->route('country.index');
        }else{
            return redirect()->back();
        }
    }
}
