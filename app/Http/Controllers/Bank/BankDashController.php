<?php
namespace App\Http\Controllers\Bank;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankDashController extends Controller
{
    public function index()
    {
        $bank       = Bank::where('user_id',Auth::id())->first();
        $bankOffer  = BankOffer::where('bank_id',$bank->id)->get();
        $page_title = __('Bank Dashboard');
        $page_description = __('View bank record');
        return  view("bank.index", compact('page_title', 'page_description','bankOffer'));
    }
}
