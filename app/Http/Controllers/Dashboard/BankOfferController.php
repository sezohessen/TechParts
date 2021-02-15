<?php

namespace App\Http\Controllers\Dashboard;
use App\DataTables\Bank_offerDatatable;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankOffer;
use Illuminate\Http\Request;

class BankOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bank_offerDatatable $bank_offer)
    {
        $page_title = __('Bank offers companies');
        $page_description = __('View offers');
        return  $bank_offer->render("dashboard.Bank-offer.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        $page_title = __("Add Bank offer");
        $page_description = __("Add new offer");
        return view('dashboard.Bank-offer.add', compact('page_title', 'page_description','banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = BankOffer::rules($request);
        $request->validate($rules);
        $credentials = BankOffer::credentials($request);
        $Bank_offer = BankOffer::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return  redirect()->route("dashboard.bank-offer.index");
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
        $bank_offer  = BankOffer::find($id);
        if($bank_offer){
            $banks = Bank::all();
            $page_title = __("Edit offer bank");
            $page_description = __("Edit");
            return view('dashboard.Bank-offer.edit', compact('page_title', 'page_description','banks','bank_offer'));
        }else{
            return redirect()->route('dashboard.bank-offer.index');
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
        $bank_offer     = BankOffer::find($id);
        $rules          = BankOffer::rules($request,'Bank-offer');
        $request->validate($rules);
        $credentials    = BankOffer::credentials($request,$request->bank_id,$bank_offer->logo_id);
        $Bank_offer     = BankOffer::where('id',$id)->update($credentials);
        session()->flash('updated',__("Changes has been Created Successfully"));
        return  redirect()->route("dashboard.bank-offer.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankOffer $bank_offer)
    {
        $bank_offer->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.bank-offer.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
                $bank_offer = BankOffer::find($id);
                if($bank_offer)
				    $bank_offer->delete();
			}
		} else {
            $bank_offer = BankOffer::find(request('item'));
            if($bank_offer)
			    $bank_offer->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.bank-offer.index");
    }
}
