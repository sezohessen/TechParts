<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator as Validator;
use App\Classes\Responseobject;
use App\Models\Bank;
use App\Models\BankContact;
use Illuminate\Http\Request;

class BankController extends Controller
{
    use GeneralTrait;
    public function home(Request $request)
    {

    }
    public function filter(Request $request)
    {
        $this->lang($request);
        $validator  = Validator::make((array) $request->all(),
            [
                'interest_country'  => 'required|integer',
                'bank_id'           => 'required|integer',
            ]
        );
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $bank   = Bank::find($request->bank_id);
        if(!$bank){
            return $this->errorMessage(__('No such bank id exist'));
        }
        $mBank  =[
            "color" =>$bank->color,
            "id"    =>$bank->id,
            "logo"  =>$bank->img->name,
            "name"  =>$bank->name,
        ];
        $bankContact    = BankContact::find($bank->id);
        $mContact   = [];
        if($bankContact){
            $mContact  =[
                "email"         => $bank->email,
                "phone"         => $bankContact->phone,
                "whats"         => $bankContact->whatsapp,
            ];
        }

    }
    public function lang($request)
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
    }
}
