<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\Request;
use App\DataTables\TermsDatatable;
class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TermsDatatable $term)
    {

        $page_title = __('Terms');
        $page_description = __('View all terms');
        return  $term->render("dashboard.Terms.show", compact('page_title', 'page_description'));
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
    public function show()
    {

        $page_title = "Terms and condition";
        $page_description = "View terms description";
        $terms = Terms::first();
        $term = $terms->description;
        return view('Terms.index',compact('page_title','page_description','term'));
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
        $term = Terms::find($id);
        $this->validate($request,[
            'description'       => 'required|min:3|max:1000',
            'description_ar'    => 'required|min:3|max:1000'
        ]);
        $term->description       = $request->description;
        $term->description_ar   = $request->description_ar;
        $term->save();

        session()->flash('success',__("Terms has been upated!"));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$terms = Terms::find($id);
				$terms->delete();
			}
		} else {
			$terms = Terms::find(request('item'));
			$terms->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.terms.index");
    }
}
