<?php

namespace App\Http\Controllers\Website;

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
        $page_title = __('Favorite');
        if(Auth::check()){
            $parts = User::find(Auth()->user()->id);
            return view('website.userFav',compact('parts','page_title'));
        }
        else return redirect()->back();
    }
    public function store($id)//Using Ajax Request
    {
        if (Auth::check()) {
            $part              = Part::findOrFail($id);
            $isExist           = UserFav::where('user_id', Auth()->user()->id)
            ->where('part_id', $id)->first() ? 1 : 0;
            if ($isExist) {
                return response()->json(['success' => false]);
            } else {
                $addToFavorite     = UserFav::create([
                'user_id' => Auth()->user()->id,
                'part_id' => $part->id]);
                $addToFavorite->save();
                $Qty        = UserFav::where('user_id',Auth()->user()->id)->get()->count();
                return response()->json(['success' => true,'Qty'=>$Qty]);
            }
        }else return redirect()->route('login');
    }
    public function destroy($id)
    {
        if (Auth::check()) {
            $deleteFav = UserFav::where('user_id',Auth()->user()->id)
            ->where('part_id',$id)
            ->first();
            if(!$deleteFav) return response()->json(['success' => false]);
            $deleteFav->delete();
            $Qty        = UserFav::where('user_id',Auth()->user()->id)->get()->count();
            return response()->json(['success' => true,'Qty'=>$Qty]);
        }
        else return redirect()->route('login');
    }
    public function storeFav($id)//Not using Ajax Request
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
                session()->flash('added', __("Part has been Added Successfully To Your Favorite"));
                return redirect()->route('Website.favorite');
            }
        }else return redirect()->route('login');
    }
}
