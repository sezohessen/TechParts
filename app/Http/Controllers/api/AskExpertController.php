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
class AskExpertController extends Controller
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
        $response   = new Responseobject();
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
