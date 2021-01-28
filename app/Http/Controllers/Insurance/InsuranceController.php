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
        $insurance      = Insurance::where('user_id',Auth::id())->first();
        if ($insurance) {
            $offers         = Insurance_offer::where('insurance_id',$insurance->id)->get();
            $offers_plan    = offer_plan::where('insurance_id',$insurance->id)->get();
        }else {
            $offers         = null;
            $offers_plan    = null;
        }
        $page_title = __('Insurance Dashboard');
        $page_description = __('View insurance record');
        return  view("insurance.index", compact('page_title', 'page_description','offers','offers_plan'));
    }
}
