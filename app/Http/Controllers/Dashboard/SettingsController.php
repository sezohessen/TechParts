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
    public function index(SettingDatatable $setting)
    {

        $page_title = __('Settings');
        $page_description = __('View  Settings');
        return  $setting->render("dashboard.Setting.index", compact('page_title', 'page_description'));
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
            'logo'          => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ]);
        $settings->appName          = $request->appName;
        $settings->appName_ar       = $request->appName_ar;

        if($request->file('logo')){
            $Image_id = self::file($request->file('logo'),$settings->logo_id);
        }
        $settings->save();
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل التعديلات"));
        } else {
            session()->flash('success',__("Settings has been updated!"));
        } */
        session()->flash('success',__("Settings has been upated!"));
        return redirect()->back();
    }
    public static function file($file,$id)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/settings/';
        $file->move($destinationPath, $fileName);
        $Image = Image::find($id);
        //Delete Old image
        try {
            $file_old = $destinationPath.$Image->name;
            unlink($file_old);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        //Update new image
        $Image->name = $fileName;
        $Image->save();
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
