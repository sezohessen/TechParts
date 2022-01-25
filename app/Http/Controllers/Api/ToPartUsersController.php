<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Http\Resources\UserCollection;
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
        return new UserCollection(User::all());
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
        $user = User::create($credentials);
        // Set Role
        if ($request['provider'] == 'seller') {
            $provider = 'seller';
        } else {
            $provider = 'user';
        }
        // Give Role
        $user->attachRole($provider);
        if($user->hasRole(User::SellerRole)){
            $isExist    = Seller::where('user_id',$user->id)->first();
            if(!$isExist)DB::table('sellers')->insert([
                'user_id'   => $user->id,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
        return new UsersResource($user);
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

    public function search($name)
    {
        $user = User::where('first_name', 'like', '%'.$name.'%')->get();
        return  UsersResource::collection($user);
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
