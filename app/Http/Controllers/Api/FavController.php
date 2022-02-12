<?php

namespace App\Http\Controllers\Api;

use App\Models\Part;
use App\Models\User;
use App\Models\UserFav;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFavRequest;
use App\Http\Resources\UserFavCollection;
use App\Http\Resources\UserFavResource;

class FavController extends Controller
{
    use GeneralTrait;

    public function showUserFav()
    {
        $usersFav = UserFav::where('user_id', auth()->user()->id)->get();
        return $this->returnData('data', new UserFavCollection($usersFav), 'favorite parts');
    }

    public function AddToFav(UserFavRequest $request)
    {
        $isExist           = UserFav::where('user_id', Auth()->user()->id)
        ->where('part_id', $request->part_id)->first() ? 1 : 0;

        if($isExist)
        {
            return $this->errorMessage('Part already exist');
        } else {
            $ifPartExist = Part::where('id', $request->part_id)->first();
            if($ifPartExist)
            {
                $addToFavorite   = UserFav::create([
                    'user_id' => Auth()->user()->id,
                    'part_id' => $request->part_id]);
                    $addToFavorite->save();
                return $this->returnData('data',new UserFavResource($addToFavorite),'Part has been added');
            } else {
                return $this->errorMessage('Part ID ' . $request->part_id . ' Is not found!');
            }
        }
    }

    public function deleteFav(Request $request)
    {
        $userFav = UserFav::where('user_id', auth()->user()->id)
        ->where('part_id', $request->part_id)->first();
        if($userFav == true)
        {
            $userFav->delete();
            return $this->returnSuccess('Part has been deleted');
        } else {
            return $this->errorMessage('Part not found with the ID ' . $request->part_id);
        }
    }
}
