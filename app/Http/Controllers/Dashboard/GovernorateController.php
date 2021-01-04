<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = 'المحافظات';
            $page_description = 'عرض جميع المحافظات';
        } else {
            $page_title = 'Governorates';
            $page_description = 'View all Governorates';
        } */
        $page_title = 'Governorates';
        $page_description = 'View all Governorates';
        $governorates = Governorate::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.Governorate.index', compact('page_title', 'page_description','governorates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "اضافة محافظة";
            $page_description = "اضافة محافظة جديدة";
        } else {
            $page_title = "Add Governorate";
            $page_description = "Add new Governorate";
        } */
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
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة المحافظة"));
        } else {
            session()->flash('success',__("Governorate has been added!"));
        } */
       session()->flash('success',__("Governorate has been added!"));
       return redirect()->route("governorate.index");
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
            $page_title = "تعديل المحافظة";
            $page_description = "تعديل";
        } else {
            $page_title = "Edit governorate";
            $page_description = "Edit";
        } */
        $page_title = "Edit governorate";
        $page_description = "Edit";
        $governorate = Governorate::find($id);
        $countries = Country::all();
        return view('dashboard.governorate.edit', compact('page_title', 'page_description','governorate','countries'));
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
}
