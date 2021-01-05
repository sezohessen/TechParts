<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\offer_plan;
use Illuminate\Http\Request;
use App\DataTables\Offer_planDatatable;
class OfferPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Offer_planDatatable $offer_plan)
    {
        $page_title = __("Offer plan");
        $page_description =__( "View Offer plan  for Insurance ");
        return  $offer_plan->render("dashboard.offer-plan.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = "Add offer plan for insurance";
        $page_description = "Add offer plan for insurance";
        $Insurances = Insurance::all();
        return view('dashboard.offer-plan.add', compact('page_title', 'page_description','Insurances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = offer_plan::rules($request);
        $request->validate($rules);
        $credentials = offer_plan::credentials($request);
        $offer_plan = offer_plan::create($credentials);

       session()->flash('success',__("Plan offer company has been added!"));
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
}
