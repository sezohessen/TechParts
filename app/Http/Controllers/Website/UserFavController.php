<?php

namespace App\Http\Controllers\website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserFavController extends Controller
{
    public function index()
    {
        $parts = User::find(Auth()->user()->id);
        // dd($user->favorite);
        // dd($parts->favorite);
        return view('website.userFav',compact('parts'));
    }
}
