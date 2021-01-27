<?php

namespace App\Http\Controllers\Dashboard;
use App\DataTables\BankDatatable;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankContact;
use App\Models\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankDatatable $bank)
    {
        $page_title = __('Bank companies');
        $page_description = __("View Banks's companies");
        return  $bank->render("dashboard.Bank.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $page_title = __("Add Bank");
        $page_description = __("Add new Bank");
        return view('dashboard.Bank.add', compact('page_title', 'page_description','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Bank::rules($request);
        $request->validate($rules);
        $credentials = Bank::credentials($request);
        $credentials['status'] = 'Approved';
        $credentials['order']  = $request->order;
        $Bank = Bank::create($credentials);
        $bank_id        = $Bank->id;
        $rules          = BankContact::rules($request);
        $request->validate($rules);
        $credentials    = BankContact::credentials($request,$bank_id);
        $BankContact    = BankContact::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return  redirect()->route("dashboard.bank.index");
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
        if($bank){
            $users      = User::all();
            $page_title = __("Edit Bank");
            $page_description = "Edit";
            return view('dashboard.Bank.edit', compact('page_title', 'page_description','users','bank','bank_contact'));
        }else{
            return redirect()->route('dashboard.bank.index');
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
        $rules       = Bank::rules($request,'Bank');
        $request->validate($rules);
        $credentials = Bank::credentials($request,$request->user_id,$Bank->logo_id);
        $credentials['status'] = $request->status;
        $credentials['order']  = $request->order;
        $bank        = Bank::where('id',$id)->update($credentials);
        $rules       = BankContact::rules($request);
        $request->validate($rules);
        $credentials = BankContact::credentials($request,$id);
        $bank_offer  = BankContact::where('bank_id',$id)->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.bank.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.bank.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$bank = Bank::find($id);
				$bank->delete();
			}
		} else {
			$bank = Bank::find(request('item'));
			$bank->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.bank.index");
    }
}
