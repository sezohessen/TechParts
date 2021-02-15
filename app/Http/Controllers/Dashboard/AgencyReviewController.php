<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\AgencyReviewDatatable;
use App\Models\AgencyReview;
class AgencyReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgencyReviewDatatable $agencyReview)
    {
        $page_title = __('Agency Reviews');
        $page_description = __('View');
        return  $agencyReview->render("dashboard.AgencyReview.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function Status(Request $request){
        $AgencyReview = AgencyReview::find($request->id);
        $AgencyReview->update(["active" => $request->status]);
        return response()->json([
            'status' => true
        ]);
    }
    public function destroy(AgencyReview $agencyReview)
    {
        $agencyReview->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.agency-review.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
                $agencyReview = AgencyReview::find($id);
                if($agencyReview)
				    $agencyReview->delete();
			}
		} else {
            $agencyReview = AgencyReview::find(request('item'));
            if($agencyReview)
			    $agencyReview->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.agency-review.index");
    }
}
