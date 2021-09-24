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
    public function store($id)
    {
        if (Auth::check()) {
            $part              = Part::find($id);
            $isExist           = UserFav::where('user_id', Auth()->user()->id)
            ->where('part_id', $part)->first() ? 1 : 0;
            if ($isExist) {
                session()->flash('Exist', __("Part Already In Your Favorite List"));
                return redirect()->route('Website.Index');
            } else {
                $addToFavorite     = UserFav::create([
                'user_id' => Auth()->user()->id,
                'part_id' => $part->id]);
                $addToFavorite->save();
                session()->flash('created', __("Part has been Added Successfully To Your Favorite"));
                return redirect()->back();
            }
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
