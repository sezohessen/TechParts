<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\DataTables\FaqDatatable;
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FaqDatatable $faq)
    {
        $page_title = __('FAQS');
        $page_description = __('Frequently Asked Questions');
        return  $faq->render("dashboard.FAQS.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __('FAQS');
        $page_description = __('Frequently Asked Questions');

        return view('dashboard.FAQS.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req\uest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Faq::rules($request);
        $request->validate($rules);
        $credentials = Faq::credentials($request);
        Faq::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("faqs.index");

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
    public function edit(Faq $faq)
    {
        $page_title = __('FAQS');
        $page_description = __('Frequently Asked Questions');
        return view('dashboard.FAQS.edit', compact('page_title', 'page_description','faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $rules =$faq->rules($request);
        $request->validate($rules);
        $credentials = $faq->credentials($request);
        $faq->update($credentials);
        session()->flash('updated',__("Changed has been updated successfully!"));
        return  redirect()->route("faqs.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("faqs.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$cities = Faq::find($id);
				$cities->delete();
			}
		} else {
			$cities = Faq::find(request('item'));
			$cities->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("faqs.index");
    }
}
