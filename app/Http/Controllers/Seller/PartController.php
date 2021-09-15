<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\Seller\PartDatatable as PartTable;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\City;
use App\Models\Part;
use App\Models\User;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PartTable $part)
    {
        $page_title         = __("Parts");
        $page_description   =__( "View parts");
        return  $part->render("SellerDashboard.Part.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title         = __("Add part");
        $page_description   =__( "Add New Record");
        $cars               = Car::all();
        return view('SellerDashboard.Part.add', compact('page_title', 'page_description','cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules          = Part::rules($request);
        $request->validate($rules);
        $credentials    = Part::credentials($request);
        $Part           = Part::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("seller.part.index");
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
    public function edit(part $part)
    {
        if($part->user_id != Auth()->user()->id)return redirect()->route('seller.index');
        $page_title         = __("Edit Part");
        $page_description   = __("Edit");
        $cars               = Car::all();
        return view('SellerDashboard.Part.edit', compact('page_title', 'page_description','cars','part'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part)
    {
        $rules          = Part::rules($request,true);
        $request->validate($rules);
        $credentials    = Part::credentials($request,true);
        $part->update($credentials);
        session()->flash('updated',__("Changes has been Created Successfully"));
        return redirect()->route("seller.part.index");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {
        $part->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("seller.part.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$part = Part::find($id);
				$part->delete();
			}
		} else {
			$part = Part::find(request('item'));
			$part->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("seller.part.index");
    }
}
