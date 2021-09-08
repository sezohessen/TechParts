<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\website\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
     $Settings = Settings::all()->first();
        return view('website.contact',compact('Settings'));
    }
     public function store(Request $request)
    {
        $rules = Contact::rules($request);
        $request->validate($rules);
        $credentials = Contact::credentials($request);
        $credentials = Contact::create($credentials);
        session()->flash('created',__("Message Has Been Send successfully"));
        return redirect()->route("Website.ContactUs");
    }
}
