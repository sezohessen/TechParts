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
        $page_title = __('Contact us');
        $page_description = __('View messages');
        return  $contact->render("dashboard.Contact.index", compact('page_title', 'page_description'));
    }

    public function show(ContactUs $contact)
    {
        $page_title = __('Contact us');
        $page_description = __('View messages');
        return  view('dashboard.Contact.show',compact('page_title','page_description','contact'));
    }


    public function destroy($id)//Not working
    {
        $ContactUs = ContactUs::find($id);
        if($ContactUs!=NULL){
            $ContactUs->delete($id);
            session()->flash('deleted',__("Changes has been Deleted Successfully"));
        }
        return redirect()->route("dashboard.contact.index");

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
