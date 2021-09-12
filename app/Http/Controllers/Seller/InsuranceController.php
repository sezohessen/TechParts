<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\offer_plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_title = __('Seller Dashboard');
        $page_description = __('Home');
        return  view("seller.index", compact('page_title', 'page_description'));
    }
}
