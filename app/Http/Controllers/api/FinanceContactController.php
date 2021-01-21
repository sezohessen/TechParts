<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Country;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator as Validator;
class FinanceContactResponseobject
{
    const status_ok = "OK";
    const status_failed = "FAILED";
    const code_ok = 200;
    const code_failed = 400;
    const code_unauthorized = 403;
    const code_not_found = 404;
    const code_error = 500;
    public $status;
    public $code;
    public $messages = array();
}
class FinanceContactController extends Controller
{
    use GeneralTrait;
    public function create(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        $data       = $request->all();
        $response   = new FinanceContactResponseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'message'           => 'required|min:3|max:1000',
            'name'              => 'required',
            'email'             => 'required|email',
            'phone'             => 'string',
            'interest_country'  => 'nullable|integer',//Will be updated
        ]);

        if (!$validator->fails()) {
            if($request->interest_country){
                $country    = Country::find($request->interest_country);
                if(!$country){
                    return $this->errorMessage(__('Not found Country id'));
                }
            }
            $ContactUs = ContactUs::create([
                'message'       => $request->message,
                'email'         => $request->email,
                'phone'         => $request->phone,
            ]);
            if($country){
                $ContactUs->country_phone = $country->country_phone;
                $ContactUs->save();
            }
            return $this->returnSuccess(__("We will contact you soon"));
        }else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->messages, $item);
            }
            return Response::json(
                $response
            );
        }
    }
}
