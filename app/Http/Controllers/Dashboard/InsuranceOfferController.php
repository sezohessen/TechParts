<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use Illuminate\Http\Request;
use App\DataTables\Insurance_offerDatatable;
class InsuranceOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Insurance_offerDatatable $insurance_offer)
    {
        $page_title = __("Insurance Offer");
        $page_description = __("View Insurance Offer");
        return  $insurance_offer->render("dashboard.insurance-offer.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Add insurance offer";
        $page_description = "Add new insurance offer";
        $Insurances = Insurance::all();
        return view('dashboard.Insurance-offer.add', compact('page_title', 'page_description','Insurances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Insurance_offer::rules($request);
        $request->validate($rules);
        $credentials = Insurance_offer::credentials($request);
        $Insurance_offer = Insurance_offer::create($credentials);
       session()->flash('success',__("Offer insurance company has been added!"));
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
    public function destroy($id)
    {
        //
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$insurance_offer = Insurance_offer::find($id);
				$insurance_offer->delete();
			}
		} else {
			$insurance_offer = Insurance_offer::find(request('item'));
			$insurance_offer->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.insurance-offer.index");
    }
}
