<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Insurance;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator as Validator;
class Responseobject
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
class InsuranceCompanyController extends Controller
{
    use GeneralTrait;
    public function show(Request $request)
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
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'interest_country'  => 'required|integer',//Will be updated
            'token'             => 'nullable',
        ]);

        if (!$validator->fails()) {
            $InsuranceCompanies = Insurance::all();//Will be updated
            $insurances = [];
            foreach ($InsuranceCompanies as $insurance) {
                $insurances[] = [
                    "color"     => '#000000',//Will be updated
                    "id"        => $insurance->id,
                    "logo"      => $insurance->img->name,
                    "name"      => Session::get('app_locale')=='ar'? $insurance->name_ar : $insurance->name,
                ];
            }
            return $this->returnData("insuranceCompanyList",$insurances,"Successfully");
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
