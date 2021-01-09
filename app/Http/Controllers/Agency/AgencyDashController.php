<?php

namespace App\Http\Controllers\Agency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgencyDashController extends Controller
{
    public function index()
    {
        $page_title = __('Agency Dashborad');
        $page_description = __('View agency record');
        return  view("agency.index", compact('page_title', 'page_description'));
    }
}
