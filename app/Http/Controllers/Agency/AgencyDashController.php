<?php

namespace App\Http\Controllers\Agency;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyDashController extends Controller
{
    public function index()
    {
        $agencies         = Agency::where('user_id',Auth::id())->get();
        if (!$agencies) {
            $agencies = NULL;
        }
        $page_title = __('Agency Dashborad');
        $page_description = __('View agency record');
        return  view("agency.index", compact('page_title', 'page_description','agencies'));
    }
}
