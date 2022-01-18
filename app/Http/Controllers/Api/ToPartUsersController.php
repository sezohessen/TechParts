<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Http\Requests\UsersStoreRequest;
use App\Http\Requests\UsersUpdateRequest;

class ToPartUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = User::get();
        return UsersResource::collection($User);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UsersStoreRequest $request)
    {
        $credentials = User::credentials($request);
        $User = User::create($credentials);
        // Set Role
        if (isset($request->provider)) {
            if($request->provider == User::SellerRole)$provider = User::SellerRole;
            else $provider = User::UserRole;
            $User->attachRole($provider);
            if($User->hasRole(User::SellerRole)){
                $isExist    = Seller::where('user_id',$User->id)->first();
                if(!$isExist)DB::table('sellers')->insert(['user_id' => $User->id,'created_at'=>now(),'updated_at'=>now()]);
            }
        }
        return new UsersResource($User);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UsersResource($user);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersUpdateRequest $request,User $user)
    {
        $credentials = User::UpdateCredentials($request);
        $user->update($credentials);
        return new UsersResource($user);
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
        return ['Result' => 'Data Has been deleted'];
    }
}
