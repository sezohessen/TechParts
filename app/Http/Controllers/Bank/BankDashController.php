<?php
namespace App\Http\Controllers\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankDashController extends Controller
{
    /* $agencies         = Agency::where('user_id',Auth::id())->get();
    if (!$agencies) {
        $agencies = NULL;
    } */
    public function index()
    {
        $page_title = __('Bank Dashborad');
        $page_description = __('View bank record');
        return  view("bank.index", compact('page_title', 'page_description'));
    }

}
