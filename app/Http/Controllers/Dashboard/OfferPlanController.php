<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\offer_plan;
use Illuminate\Http\Request;
use App\DataTables\Offer_planDatatable;
use Illuminate\Support\Facades\Auth;

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

        $page_title = __("Add offer plan for insurance");
        $page_description = __("Add");
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
       return redirect()->route('dashboard.offer-plan.index');
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
        $offer_plan = offer_plan::find($id);
        $Insurances = Insurance::all();
        //User can access only his Insurance campony offer
        if($offer_plan){
            return redirect()->route('dashboard.offer-plan.index');
        }else{
            $page_title = "Edit offer plan";
            $page_description = "Edit offer plan record";
            return view('dashboard.offer-plan.edit', compact('page_title', 'page_description','offer_plan','Insurances'));
        }
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
        $rules      = offer_plan::rules($request);
        $request->validate($rules);
        $credentials = offer_plan::credentials($request);
        $offer_plan = offer_plan::where('id',$id)->update($credentials);
        session()->flash('success',__("Offer plan has been updated!"));
        return redirect()->route('dashboard.offer-plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(offer_plan $offer_plan)
    {
        $offer_plan->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.offer-plan.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$offer_plan = offer_plan::find($id);
				$offer_plan->delete();
			}
		} else {
			$offer_plan = offer_plan::find(request('item'));
			$offer_plan->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.offer-plan.index");
    }
}
