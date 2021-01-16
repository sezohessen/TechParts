<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\offer_plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\Insurance\Offer_planDatatable;

class OfferPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Offer_planDatatable $offer_plan)
    {
        $page_title = __("Offers plan");
        $page_description = __("View Offers plan");
        return  $offer_plan->render("InsuranceDashboard.offer-plan.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $insurance  = Insurance::where('user_id',Auth::id())
        ->first()
        ->id;
        $offers = Insurance_offer::where('insurance_id',$insurance)->get();
        if($offers){
            $page_title = "Add offer plan for insurance";
            $page_description = "Add offer plan for insurance";
            return view('InsuranceDashboard.offer-plan.add', compact('page_title', 'page_description','offers'));
        }else{

            $page_title = "Add insurance offer";
            $page_description = "Add new insurance offer";
            return view('InsuranceDashboard.Insurance-offer.add', compact('page_title', 'page_description'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insurance  = Insurance::where('user_id',Auth::id())->first();
        $id         = $insurance->id;
        $rules      = offer_plan::rules($request,$id);
        $request->validate($rules);
        $credentials = offer_plan::credentials($request,$id);
        $offer_plan = offer_plan::create($credentials);
       session()->flash('success',__("Plan offer company has been added!"));
       return redirect()->route('insurance.offer-plan.index');
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
        $insurance  = Insurance::where('user_id',Auth::id())->first();
        $offers     = Insurance_offer::where('insurance_id',$insurance->id)->get();
        //User can access only his Insurance campony offer
        if($offer_plan==NULL||$offers->count()==0){
            return redirect('/insurance');
        }else{
            if($offer_plan->insurance_id==$insurance->id){
                $page_title = "Edit offer plan";
                $page_description = "Edit offer plan record";
                return view('InsuranceDashboard.offer-plan.edit', compact('page_title', 'page_description','offer_plan','offers'));
            }else{
                return redirect('/insurance');
            }
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
        $insurance  = Insurance::where('user_id',Auth::id())->first();
        $rules      = offer_plan::rules($request,$insurance->id);//Request,Insurance,offer img
        $request->validate($rules);
        $credentials = offer_plan::credentials($request,$insurance->id);
        $offer_plan = offer_plan::where('id',$id)->update($credentials);
        session()->flash('success',__("Offer plan has been updated!"));
        return redirect()->route('insurance.offer-plan.index');
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
        return redirect()->route("insurance.offer-plan.index");
    }
}
