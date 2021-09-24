<?php

namespace App\Http\Controllers\website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\UserFav;
use Illuminate\Support\Facades\Auth;

class UserFavController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $parts = User::find(Auth()->user()->id);
            return view('website.userFav',compact('parts'));
        }

        else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
      
        $deleteFav = UserFav::where('part_id',$id)->first();
        // dd($deleteFav);
        $deleteFav->delete();
        session()->flash('deleted',__("Part has been Deleted Successfully From Your Favorite"));
        return redirect()->back();
    }
}
