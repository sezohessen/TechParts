<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\subscribe_package;
use App\DataTables\SubscribeDatatable;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscribeDatatable $subscribe_package)
    {
        $page_title = __("Subscription");
        $page_description =__( "View Subscriptions");
        return  $subscribe_package->render("dashboard.subscribe_package.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a subscribe_package resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Subscription item");
        $page_description = __("Add Subscription item");
        return view('dashboard.subscribe_package.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a subscribe_packagely created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = subscribe_package::rules($request);
        $request->validate($rules);
        $credentials = subscribe_package::credentials($request);
         subscribe_package::create($credentials);
        session()->flash('created',__("Changes has been Created successfully!"));
        return redirect()->route("dashboard.subscribe_packages.index");
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
    public function edit(subscribe_package $subscribe_package)
    {

        $page_title = __("Edit Subscription item");
        $page_description = __("Edit Subscription item");
        return view('dashboard.subscribe_package.edit', compact('page_title', 'page_description',"subscribe_package"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,subscribe_package $subscribe_package)
    {
        $rules =$subscribe_package->rules($request);
        $request->validate($rules);
        $credentials = $subscribe_package->credentials($request);
        $subscribe_package->update($credentials);
        session()->flash('updated',__("Changed has been updated successfully!"));
        return redirect()->route("dashboard.subscribe_packages.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(subscribe_package $subscribe_package)
    {
        $subscribe_package->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.subscribe_packages.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$subscribe_package = subscribe_package::find($id);
				$subscribe_package->delete();
			}
		} else {
			$subscribe_package = subscribe_package::find(request('item'));
			$subscribe_package->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.subscribe_packages.index");
    }
}
