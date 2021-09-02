<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CarDatatable;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\DataTables\UserDatatable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDatatable $user)
    {
        $page_title = __('Users');
        $page_description = __('Manage Users');
        return  $user->render("dashboard.User.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add User");
        $page_description = __("Add new User");
        $countries =Country::where('active',1);
        return view('dashboard.User.add', compact('page_title', 'page_description','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $rules = User::rules();
        $request->validate($rules);
        $credentials = User::credentials($request);
        $provider = 'user';
        $user = User::create($credentials);
        $user->attachRole($provider);
        session()->flash('created',__("Changes has been Created successfully"));
        return redirect()->route("dashboard.users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CarDatatable $car,User $user)
    {
        $page_title = __('User');
        $page_description = __('Manage User');
        $car->request()->all();
        return  $car->render("dashboard.User.show", compact('page_title', 'page_description','user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $page_title = __("Edit User");
        $page_description = __("Edit new User");

        return view('dashboard.User.edit', compact('page_title', 'page_description','countries','provider','user','selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules =User::rules(null, $user->id);
        $request->validate($rules);

        //$user->attachRole($provider) ;
        session()->flash('updated',__("Changes has been Updated successfully"));
        return redirect()->route("dashboard.users.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.users.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$user = User::find($id);
				$user->delete();
			}
		} else {
			$user = User::find(request('item'));
			$user->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.users.index");
    }
}
