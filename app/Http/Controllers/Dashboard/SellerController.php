<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SellerDatatable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SellerDatatable $seller)
    {
        $page_title = __("Sellers");
        $page_description =__( "View details");
        return  $seller->render("dashboard.Seller.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function edit(Seller $seller)
    {
        $page_title         = __("Edit Seller");
        $page_description   = __("Edit");
        $governorates       = Governorate::all();

        return view('dashboard.Seller.edit', compact('page_title', 'page_description','seller',
        'governorates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Seller $seller)
    {
        $rules  =  Seller::rules($request);
        $request->validate($rules);
        $seller->update(Seller::credentials($request));
        session()->flash('updated',__("Changes has been Updated successfully"));
        return redirect()->route("dashboard.seller.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.seller.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$seller = Seller::find($id);
				$seller->delete();
			}
		} else {
			$seller = Seller::find(request('item'));
			$seller->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.seller.index");
    }
}
