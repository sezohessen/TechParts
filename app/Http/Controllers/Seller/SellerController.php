<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $page_title = __('Seller Dashboard');
        $page_description = __('Home');
        return  view("seller.index", compact('page_title', 'page_description'));
    }
}
