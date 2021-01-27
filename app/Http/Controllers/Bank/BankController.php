<?php

namespace App\Http\Controllers\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\BankContact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank           = Bank::where('user_id',Auth::id())->first();
        if($bank!=NULL){
            return $this->edit($bank->id);
        }else{
            $page_title       = __("Add Bank");
            $page_description = __("Add bank information");
            return view('BankDashboard.Bank.add', compact('page_title', 'page_description'));
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
        $rules = Bank::rules($request,'BankDash');
        $request->validate($rules);
        $credentials = Bank::credentials($request,Auth::id(),NULL,0);
        $credentials['status'] = 'Pending';
        $Bank = Bank::create($credentials);
        $bank_id        = $Bank->id;
        $rules          = BankContact::rules($request);
        $request->validate($rules);
        $credentials    = BankContact::credentials($request,$bank_id);
        $BankContact    = BankContact::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return  redirect()->route('bank.index');
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
        $bank           = Bank::find($id);
        $bank_contact   = BankContact::where('bank_id',$id)->first();
        if($bank && Auth::id() ==$bank->user_id){
            $page_title = __("Edit Bank");
            $page_description = __("Edit");
            return view('BankDashboard.Bank.edit', compact('page_title', 'page_description','bank','bank_contact'));
        }else{
            return view('BankDashboard.Bank.index', compact('page_title', 'page_description'));
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
        $Bank        = Bank::find($id);
        $rules       = Bank::rules($request,$id);
        $request->validate($rules);
        $credentials = Bank::credentials($request,Auth::id(),$Bank->logo_id,0);
        $credentials['status'] = $Bank->status;//It will be updated after -> as admin will approve the updated information
        $bank        = Bank::where('id',$id)->update($credentials);
        $rules       = BankContact::rules($request);
        $request->validate($rules);
        $credentials = BankContact::credentials($request,$id);
        $bank_offer  = BankContact::where('bank_id',$id)->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return  redirect()->route('bank.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
