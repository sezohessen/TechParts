<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\News;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\DataTables\SettingDatatable;
use Exception;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_title = __('Settings');
        $page_description = __('View');
        $settings = Settings::first();
        return view('dashboard.Setting.index', compact('page_title', 'page_description','settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $settings = Settings::find($id);
        $this->validate($request,[
            'appName'       => 'required|string|max:255',
            'appName_ar'    => 'required|string|max:255',
            'logo'          => 'nullable|image|mimes:jpeg,jpg,png,svg',
            'email'         => 'nullable|string|max:255|email',
            'phone'         => 'nullable|string|max:55',
            'whatsapp'      => 'nullable|string|max:255',
            'facebook'      => 'nullable|string|max:255',
            'instgram'      => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'andriod'       => 'nullable|string|max:255',
            'ios'           => 'nullable|string|max:255',
        ]);
        $settings->appName          = $request->appName;
        $settings->appName_ar       = $request->appName_ar;
        $settings->email            = $request->email;
        $settings->phone            = $request->phone;
        $settings->Whatsapp         = $request->Whatsapp;
        $settings->facebook         = $request->facebook;
        $settings->instgram         = $request->instgram;
        $settings->location         = $request->location;
        $settings->andriod          = $request->andriod;
        $settings->ios              = $request->ios;

        if($request->file('logo')){
            $Image_id = add_Image($request->file('logo'),$request->logo_id, Settings::base);
            $settings->logo_id = $Image_id;
        }
        $settings->update();
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل التعديلات"));
        } else {
            session()->flash('success',__("Settings has been updated!"));
        } */
        session()->flash('success',__("Settings has been updated!"));
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
        //
    }
}
