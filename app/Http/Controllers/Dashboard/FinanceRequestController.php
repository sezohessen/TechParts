<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Finance_request;
use Illuminate\Http\Request;
use App\DataTables\Finance_requestDatatable;
class FinanceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Finance_requestDatatable $Finance_request)
    {
        $page_title = __('Finance Request');
        $page_description = __('Finance Request');
        return  $Finance_request->render("dashboard.Finance-request.index", compact('page_title', 'page_description'));
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
    public function edit(Finance_request $Finance_request)
    {
        $page_title = "View  Finance Request";
        $page_description = "Finance Request Information";
        $request = Finance_request::find($Finance_request->id);
        return view('dashboard.Finance-request.edit', compact('page_title', 'page_description','request'));
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
        $Finance_request = Finance_request::find($id);
        $this->validate($request,[
            'status'       => 'required',
        ]);
        $Finance_request->status          = $request->status;
        $Finance_request->save();
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل التعديلات"));
        } else {
            session()->flash('success',__("Settings has been updated!"));
        } */
        session()->flash('updated',__("Finacne request has been upated!"));
        return redirect()->route('dashboard.finance-request.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance_request $finance_request)
    {
        $finance_request->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.finance-request.index");
    }
     public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$Finance_request = Finance_request::find($id);
				$Finance_request->delete();
			}
		} else {
			$Finance_request = Finance_request::find(request('item'));
			$Finance_request->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.finance-request.index");
    }
}
