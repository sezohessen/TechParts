<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CarDatatable;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\DataTables\UserDatatable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;
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
        return view('dashboard.User.add', compact('page_title', 'page_description'));
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
        $provider = User::UserRole;
        $user = User::create($credentials);
        if (isset($request->provider)) {
            if($request->provider == User::SellerRole)$provider = User::SellerRole;
            else $provider = User::UserRole;
            $user->attachRole($provider);
            if($user->hasRole(User::SellerRole)){
                /*
                if the admin change the role of user to be seller -> (if seller has info then create row in seller table else do not create row)
                if the admin change the role of seller to be user -> keep seller data as it is that.
                */
                $isExist    = Seller::where('user_id',$user->id)->first();
                if(!$isExist)DB::table('sellers')->insert(['user_id' => $user->id,'created_at'=>now(),'updated_at'=>now()]);
            }
        }
        session()->flash('created',__("Changes has been Created successfully"));
        return redirect()->route("dashboard.users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $page_title         = __("Edit User");
        $page_description   = __("Edit new User");

        if($user->hasRole('seller'))$provider = User::SellerRole;
        else $provider = User::UserRole;
        return view('dashboard.User.edit', compact('page_title', 'page_description','provider','user'));
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
        $rules =    User::rules(null, $user->id);
        $request->validate($rules);

        if (isset($request->provider)) {
            if($user->hasRole(User::SellerRole))$provider = User::SellerRole;
            else $provider = User::UserRole;
            $user->detachRole($provider);
            $user->attachRole($request->provider);
            //if admin change user's role to seler , it will be auto created this details
            if($user->hasRole(User::SellerRole)){
                /*
                if the admin change the role of user to be seller -> (if seller has info then create row in seller table else do not create row)
                if the admin change the role of seller to be user -> keep seller data as it is that.
                */
                $isExist    = Seller::where('user_id',$user->id)->first();
                if(!$isExist)DB::table('sellers')->insert(['user_id' => $user->id]);
            }
        }
        $user->update(User::credentials($request,true));
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
