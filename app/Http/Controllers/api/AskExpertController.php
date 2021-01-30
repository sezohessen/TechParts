<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AskExpert;
use Illuminate\Http\Response;
use App\Models\News;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;


class AskExpertController extends Controller
{
    use GeneralTrait;
    public function create(Request $request)
    {
        $this->lang($request->lang);
        $data       = $request->all();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'question'       => 'required|min:3|max:1000',
        ]);

        if (!$validator->fails()) {
            $askExpert = AskExpert::create([
                'message'       => $request->question,
                'email'         => auth()->user()->email,
                'phone'         => auth()->user()->phone,
                'country_phone' => auth()->user()->country_phone,
            ]);
            return $this->returnSuccess(__("We will contact you soon"));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
}
