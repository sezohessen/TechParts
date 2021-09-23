<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\CarMaker;
use Illuminate\Http\Request;
use App\DataTables\CarMakeDatatable;
class CarMakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $page_title         = __("Add company name");
        $page_description   = __("Company name");

        return view('SellerDashboard.CarMaker.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules          = CarMaker::rules($request);
        $request->validate($rules);
        $credentials    = CarMaker::credentials($request);
        $CarMaker       = CarMaker::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("seller.model.create");
    }
}
