<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFavController extends Controller
{
    public function index()
    {
        return view('website.userFav');
    }
}
