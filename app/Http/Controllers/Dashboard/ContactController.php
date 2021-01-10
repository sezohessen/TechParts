<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\DataTables\ContactDatatable;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactDatatable $contact)
    {
        $page_title = __('Ask An Expert');
        $page_description = __('View Ask An Expert');
        return  $contact->render("dashboard.Contact.index", compact('page_title', 'page_description'));
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
    public function destroy($id)//Not working
    {
        $ContactUs = ContactUs::find($id);
        if($ContactUs!=NULL){
            $ContactUs->delete($id);
            session()->flash('deleted',__("Changes has been Deleted Successfully"));
        }
        return redirect()->route("dashboard.contact.index");
       /*  $askExpert = AskExpert::find($id);
        if($askExpert->count()!=0){
            $askExpert->delete($id);
             if (Session::get('app_locale') == 'ar') {
            session()->flash('delete',__(" تم الحذف بنجاح!  "));
            } else {
                session()->flash('delete',__("Row has been deleted successfully!"));
            }
            session()->flash('delete', 'Row has been deleted successfully!');
            return redirect()->route('dashboard.AskExpert.index');
        }else{
            return redirect()->back();
        } */
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$ContactUs = ContactUs::find($id);
				$ContactUs->delete();
			}
		} else {
			$ContactUs = ContactUs::find(request('item'));
			$ContactUs->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.contact.index");
    }
}
