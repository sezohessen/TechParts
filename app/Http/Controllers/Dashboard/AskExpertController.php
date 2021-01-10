<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\DataTables\AskAnExpertDatatable;
use App\Models\AskExpert;
use Illuminate\Http\Request;

class AskExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AskAnExpertDatatable $askExpert)
    {
        $page_title = __('Ask An Expert');
        $page_description = __('View Ask An Expert');
        return  $askExpert->render("dashboard.AskAnExpert.index", compact('page_title', 'page_description'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//Not working
    {
        $askExpert = AskExpert::find($id);
        if($askExpert!=NULL){
            $askExpert->delete($id);
            session()->flash('deleted',__("Changes has been Deleted Successfully"));
        }
        return redirect()->route("dashboard.AskExpert.index");
       /*  $askExpert = AskExpert::find($id);
        if($askExpert->count()!=0){
            $askExpert->delete($id);
             if (Session::get('app_locale') == 'ar') {
            session()->flash('delete',__(" تم الحذف بنجاح!  "));
            } else {
                session()->flash('delete',__("Row has been deleted successfully!"));
            }
            session()->flash('delete', 'Row has been deleted successfully!');
            return redirect()->route('dashboard.AskExpert.index');
        }else{
            return redirect()->back();
        } */
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$askExpert = AskExpert::find($id);
				$askExpert->delete();
			}
		} else {
			$askExpert = AskExpert::find(request('item'));
			$askExpert->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.AskExpert.index");
    }
}
