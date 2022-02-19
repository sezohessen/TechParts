<?php

namespace App\Http\Controllers\Api;

use App\Traits;
use App\Models\User;
use App\Models\Seller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UsersStoreRequest;
use App\Http\Requests\UsersUpdateRequest;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ToPartUsersController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new UserCollection(User::paginate(10)))->additional(['status' =>
            [ 'success' => true , 'msg' => 'all users']
        ]);
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

        return $this->returnData('data',new UsersResource($user),'Account has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id' , $id)->first();
        if($user)
        {
            return $this->returnData('data',new UsersResource($user),'Account has been found');
        } else {
            return $this->returnFailData('data',null,'Account not found!');
        }

    }

    public function search($name)
    {
        $user = User::where('first_name', 'like', '%'.$name.'%')->paginate(10);
        return  new UserCollection($user);
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
        return $this->returnData('data', new UsersResource($user),'Account has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->first();
        if($user == true)
        {
            $user->delete();
            return $this->returnSuccess('Account has been deleted');
        } else {
            return $this->errorMessage('Account not found with the ID of ' . $id);
        }

    }
}
